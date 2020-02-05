<?php


namespace IdnoPlugins\Courseware\Entities;

class Module extends CoursewareEntity {
    public function fields(): array {
	return [
	    'name' => 'text',
	    'image' => 'file',
	    'video' => 'url',
	    'readings' => 'reading',
	    'tasks' => 'tasks',
	    'assignments' => 'assignments'
	];
    }

    public function fieldsDefaults(): array {
	return [
	    'name',
	    'image',
	    'video',
	];
    }

    public function fieldsLabels(): array {
	return [
	    'name' => \Idno\Core\Idno::site()->language()->_('Name'),
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
	];
    }

    public function fieldsHelp(): array {
	return [];
    }
}