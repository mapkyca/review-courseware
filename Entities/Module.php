<?php


namespace IdnoPlugins\Courseware\Entities;

use Idno\Core\Idno;
use IdnoPlugins\Like\Like;
use IdnoPlugins\Event\Event;

class Module extends CoursewareEntity {
    public function fields(): array {
	return [
	    
	    'name' => 'text',
	    'description' => 'longtext',
	    'image' => 'file',
	    'video' => 'url',
	    'readings' => 'reading',
	    'tasks' => 'tasks',
	    'criteria' => 'text',
	    'evidence' => 'text'
	];
    }

    public function fieldsDefaults(): array {
	return [
	    
	];
    }

    public function fieldsLabels(): array {
	return [
	    'name' => \Idno\Core\Idno::site()->language()->_('Name'),
	    'description' => \Idno\Core\Idno::site()->language()->_('Module Description'),
	    'image' => \Idno\Core\Idno::site()->language()->_('Upload Image'),
	    'video' => \Idno\Core\Idno::site()->language()->_('Link to Video'),
	    'readings' => \Idno\Core\Idno::site()->language()->_('Add a reading'),
	    'tasks' => \Idno\Core\Idno::site()->language()->_('Add a task'),
	    'criteria' => \Idno\Core\Idno::site()->language()->_('Add criteria'),
	    'evidence' => \Idno\Core\Idno::site()->language()->_('Add evidence')
	];
    }

    public function fieldsPlaceholders(): array {
	return [
	    'criteria' => \Idno\Core\Idno::site()->language()->_('Assessment criteria'),
	    'evidence' => \Idno\Core\Idno::site()->language()->_('Assessment evidence'),
	];
    }

    public function fieldsRequired(): array {
	return [
	    'name',
	    'description',
	    'video',
	];
    }

    public function fieldsHelp(): array {
	return [];
    }
    
    public function saveDataFromInput() {
	
	$new = false;
	
	if (!$this->getID()) {
	    
	    $new = true;
	}
	
	$result = parent::saveDataFromInput();
	
	if ($new) {
	    $this->course_id = \Idno\Core\Idno::site()->currentPage()->getInput('course_id');
	}
	
	if ($result) {
	
	    // Construct bookmarks out of readings
	    $readings = \Idno\Core\Idno::site()->currentPage()->getInput('readings');
	    if (!empty($readings)) {
		foreach ($readings as $key => $reading) {
		    
		    $decoded = json_decode($reading);
		    if (!empty($decoded)) {
			
			$bookmark = null;
			if ($decoded->reading_id) {
			    $bookmark = Like::getByID($decoded->reading_id);
			    
			} else {
			    $bookmark = new Like();
			    
			    $bookmark->course_id = $this->course_id;
			    $bookmark->module_id = $this->getID();
			}
			
			$bookmark->body = $decoded->url;
			$bookmark->description = $decoded->description;
			$bookmark->title = $decoded->title;
			$bookmark->author = $decoded->author;
			
			if (($owner = \Idno\Entities\User::getByHandle($decoded->author)) || ($owner = \Idno\Entities\User::getByEmail($decoded->author))) {
			    $bookmark->setOwner($owner);
			    $bookmark->setAccess($this->getAccess());
			}
			
			// Update blobs
			$decoded->reading_id = $bookmark->save();
			$readings[$key] = json_encode($decoded);
		    } 
		    
		}
		
		// Save updated readings
		$this->readings = $readings;
	    } 
	    
	    
	    // Construct tasks out of event
	    $tasks = \Idno\Core\Idno::site()->currentPage()->getInput('tasks');
	    if (!empty($tasks)) {
		foreach ($tasks as $key => $task) {
		    
		    $decoded = json_decode($task);
		    if (!empty($decoded)) {
			
			$event = null;
			if ($decoded->task_id) {
			    $event = Event::getByID($decoded->task_id);
			    
			} else {
			    $event = new Event();
			    
			    $event->course_id = $this->course_id;
			    $event->module_id = $this->getID();
			}
			
			$event->body = $decoded->description;
			$event->title = $decoded->name;
			$event->starttime = $decoded->start;
			$event->endtime = $decoded->end;
			
			// Update blobs
			$decoded->task_id = $event->save();
			$tasks[$key] = json_encode($decoded);
		    } else {
			unset($tasks[$key]);
		    }
			
		    
		}
		
		// Save updated tasks
		$this->tasks = $tasks;
	    }
	    
	} 
	
	$this->save();
	
	return $result;
    }
}