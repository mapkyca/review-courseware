<?php

namespace IdnoPlugins\Courseware\Pages\Entities\Course;

use Idno\Core\Idno;
use Idno\Common\Page;
use IdnoPlugins\Courseware\Entities\Course;

class Edit extends Page {

    function getContent() {

	$this->createGatekeeper();    // This functionality is for logged-in users only
	
	// Are we loading an entity?
	if (!empty($this->arguments)) {
	    $object = Course::getByID($this->arguments[0]);
	} else {
	    $object = new Course();
	}

	if (!$object)
	    $this->noContent();

	if ($owner = $object->getOwner()) {
	    $this->setOwner($owner);
	}

	$t = Idno::site()->template();
	$edit_body = $t->__(array(
		    'object' => $object
		))->draw('entity/Course/edit');

	$body = $t->__(['body' => $edit_body])->draw('entity/editwrapper');

	if (empty($object)) {
	    $title = Idno::site()->language()->_('Upload a picture');
	} else {
	    $title = Idno::site()->language()->_('Edit picture details');
	}

	if (!empty($this->xhr)) {
	    echo $body;
	} else {
	    $t->__(array('body' => $body, 'title' => $title))->drawPage();
	}
    }

    function postContent() {
	$this->createGatekeeper();

	$new = false;
	if (!empty($this->arguments)) {
	    $object = Course::getByID($this->arguments[0]);
	}
	if (empty($object)) {
	    $object = new Course();
	}

	if ($object->saveDataFromInput()) {
	    $forward = $this->getInput('forward-to', $object->getDisplayURL());
	    $this->forward($forward);
	}
    }

}
