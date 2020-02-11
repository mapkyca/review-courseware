<?php


namespace IdnoPlugins\Courseware\Entities;

class Module extends CoursewareEntity {
    public function fields(): array {
	return [
	    'course_id' => 'hidden',
	    'name' => 'text',
	    'description' => 'longtext',
	    'image' => 'file',
	    'video' => 'url',
	    'readings' => 'reading',
	    'tasks' => 'tasks',
	    'assignments' => 'assignments'
	];
    }

    public function fieldsDefaults(): array {
	return [
	    'course_id' => $this->course_id??\Idno\Core\Input::getInput('course_id')
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
	    'assignments' => \Idno\Core\Idno::site()->language()->_('Add assignment')
	];
    }

    public function fieldsPlaceholders(): array {
	return [];
    }

    public function fieldsRequired(): array {
	return [
	    'name',
	    'description',
	    'image',
	    'video',
	];
    }

    public function fieldsHelp(): array {
	return [];
    }
}