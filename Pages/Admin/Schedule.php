<?php

namespace IdnoPlugins\Courseware\Pages\Admin;

use Idno\Common\Page;
use Idno\Core\Idno;
use IdnoPlugins\Courseware\Entities\Course;
use IdnoPlugins\Event\Event;

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
	
	
	// Save tasks
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

			$event->course_id = $object->getID();
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
	
	$events = \Idno\Core\Idno::site()->currentPage()->getInput('events');
	if (!empty($events)) {
	    foreach ($events as $key => $event) {

		$decoded = json_decode($event);
		if (!empty($decoded)) {

		    $event = null;
		    if ($decoded->event_id) {
			$event = Event::getByID($decoded->event_id);

		    } else {
			$event = new Event();

			$event->course_id = $object->getID();
		    }

		    $event->body = $decoded->description;
		    $event->title = $decoded->name;
		    $event->starttime = $decoded->start;
		    $event->endtime = $decoded->end;

		    // Update blobs
		    $decoded->event_id = $event->save();
		    $events[$key] = json_encode($decoded);
		} else {
		    unset($events[$key]);
		}


	    }

	    // Save updated events
	    $this->events = $events;
	}
	
	
	$object->save();
	
    }
}

