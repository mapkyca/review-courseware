<?php

namespace IdnoPlugins\Courseware\Entities;

use Idno\Common\Entity;
use Idno\Core\Idno;
use Idno\Entities\File;
use Idno\Files\FileSystem;
use Idno\Core\Input;

abstract class CoursewareEntity extends Entity {

    // Mix in field helpers
    use Fields\Definition;

    public function getURL() {
	
	$path = explode('\\', get_class($this));
    
	$classname = strtolower(array_pop($path));
	
	return \Idno\Core\Idno::site()->config()->getDisplayURL() . ltrim($classname, '/') . '/view/' . $this->getID() . '/';
    }
    
    public function getEditURL() {
	
	$path = explode('\\', get_class($this));
    
	$classname = strtolower(array_pop($path));
	
	if ($this->getID()) $id = $this->getID() . '/';
	
	return \Idno\Core\Idno::site()->config()->getDisplayURL() . 'admin/courseware/' . ltrim($classname, '/') . '/edit/' . $id;
    }
    
    public function getTitle() {
	if (!empty($this->name))
	    return $this->name;
	
	return parent::getTitle();
    }
    
    /**
     * Saves changes to this object based on user input
     * @return bool
     */
    function saveDataFromInput() {

	if (empty($this->_id)) {
	    $new = true;
	} else {
	    $new = false;
	}
	
	$fields = $this->fields();
	$defaults = $this->fieldsDefaults();
	$required = $this->fieldsRequired();
	
	$access = Idno::site()->currentPage()->getInput('access');
	$this->setAccess($access);
	
	foreach ($fields as $variable => $type) {
	    
	    switch ($type) {
	    
		case 'file':
		case 'image-file':
		    $files = Input::getFiles($variable);
		    if (!isset($files['name'])) {
			$files = array_filter($files, function($var) {
			    return !empty($var['tmp_name']); // Filter non-filled in elements
			});
		    } else {
			$files = [$files]; // Handle situations where we aren't handling array of photos
		    }
		    
		    foreach ($files as $_file) {

			if (!empty($_file['tmp_name'])) {

			    if (File::isImage($_file['tmp_name']) || File::isSVG($_file['tmp_name'], $_file['name'])) {

				// Extract exif data so we can rotate
				if (is_callable('exif_read_data') && $_file['type'] == 'image/jpeg') {
				    try {
					if (function_exists('exif_read_data')) {
					    if ($exif = exif_read_data($_file['tmp_name'])) {
						$this->exif = base64_encode(serialize($exif)); 
					    }
					}
				    } catch (\Exception $e) {
					$exif = false;
				    }
				} else {
					    
				    $exif = false;
				    
				}

				if ($photo = File::createFromFile($_file['tmp_name'], $_file['name'], $_file['type'], true, true)) {
				    $this->attachFile($photo);

				    // Now get some smaller thumbnails, with the option to override sizes
				    $sizes = Idno::site()->events()->dispatch('photo/thumbnail/getsizes', new \Idno\Core\Event([
					'sizes' => [
						'large' => 800, 
						'medium' => 400, 
						'small' => 200
					    ]
					]));
				    
				    $eventdata = $sizes->data();
				    foreach ($eventdata['sizes'] as $label => $size) {

					$filename = $_file['name'];

					if ($_file['type'] != 'image/gif') {
					    if ($thumbnail = File::createThumbnailFromFile($_file['tmp_name'], "{$filename}_{$label}", $size, false)) {
		
						// New style thumbnails
						$varname        =   "thumbs_{$label}";
						if (empty($this->$varname))
						    $this->$varname = [];

						$this->$varname[$filename] = [
						    'id'    => substr($thumbnail, 0, strpos($thumbnail, '/')),
						    'url'   => Idno::site()->config()->url . 'file/' . $thumbnail,
						];
					    }
					}
				    }

				} else {
				    Idno::site()->session()->addErrorMessage(Idno::site()->language()->_('Image wasn\'t attached.'));
				    return false;
				}
			    } else {
				Idno::site()->session()->addErrorMessage(Idno::site()->language()->_('This doesn\'t seem to be an image...'));
				return false;
			    }

			} else {

			    if (!empty($required[$variable])) {
				
				$errcode = null;
				if (!empty($_file['error']))
				    $errcode = $_file['error'];

				$errmsg = FileSystem::getUploadErrorCodeMessage($errcode);
				if (!empty($errcode) && !empty($errmsg)) {

				    // No file is ok, if this is not new
				    if (intval($errcode) == UPLOAD_ERR_NO_FILE && !$new) {
					$errmsg = null;
				    }
				} else {
				    $errmsg = Idno::site()->language()->_('We couldn\'t access your image for an unknown reason. Please try again.');
				}
				if (!empty($errmsg)) {
				    Idno::site()->session()->addErrorMessage($errmsg);
				    return false;
				}
			    }
			}
		    }
		    break;
		default:
		    $this->$variable = Idno::site()->currentPage()->getInput($variable, $defaults??null);
		    if ($required[$variable]) {
			if (empty($this->$variable)) {
			    Idno::site()->session()->addErrorMessage(Idno::site()->language()->_('Sorry, a required field was not provided.'));
			    return false;
			}
		    }
	    }
	    
	}
	
	if ($this->publish($new)) {
	    
	    return true;
	    
	} else {
	    
	    return false;
	    
	}
	
    }

}
