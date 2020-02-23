<?php

namespace IdnoPlugins\Courseware\Pages\Admin;

use Idno\Common\Page;
use Idno\Core\Idno;
use IdnoPlugins\Courseware\Entities\Course;

class Schedule extends Page {
    
    public function getContent() {
	
	
	$this->createGatekeeper();    // This functionality is for logged-in users only
	
	// Are we loading an entity?
	if (!empty($this->arguments)) {
	    $object = Course::getByID($this->arguments[0]);
	} 
	
	if (!$object)
	    $this->noContent();

	if ($owner = $object->getOwner()) {
	    $this->setOwner($owner);
	}
	
	$t = Idno::site()->template();
	
	$title = Idno::site()->language()->_('Schedule');
	
	
	echo $t->__(array('body' => $t->__(['course' => $object])->draw('admin/Courseware/schedule'), 'title' => $title))->drawPage();
	
    }
    
    public function postContent() {
	$this->createGatekeeper();    // This functionality is for logged-in users only
	
	// Are we loading an entity?
	if (!empty($this->arguments)) {
	    $object = Course::getByID($this->arguments[0]);
	} 
	
	if (!$object)
	    $this->noContent();

	if ($owner = $object->getOwner()) {
	    $this->setOwner($owner);
	}
	
	
	// TODO save schedule
	
    }
}

