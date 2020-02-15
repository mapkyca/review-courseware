<?php


namespace IdnoPlugins\Courseware\Entities;

class Course extends CoursewareEntity {
    
    public function fields(): array {
	return [
	    'name' => 'text',
	    'image' => 'file',
	    'alt' => 'text',
	    'description' => 'richtext',
	    'objectives' => 'objectives',
	    'codeofconduct' => 'codeofconduct',
	    
	];
    }

    public function fieldsDefaults(): array {
	return [];
    }

    public function fieldsLabels(): array {
	return [
	    'name' => \Idno\Core\Idno::site()->language()->_('Course Name'),
	    'image' => \Idno\Core\Idno::site()->language()->_('Upload Image'),
	    'alt' => \Idno\Core\Idno::site()->language()->_('Alt'),
	    'description' => \Idno\Core\Idno::site()->language()->_('Course Description'),
	    'objectives' => \Idno\Core\Idno::site()->language()->_('Objectives'),
	    'codeofconduct' => \Idno\Core\Idno::site()->language()->_('Do you want a code of conduct?'),
	];
    }

    public function fieldsPlaceholders(): array {
	return [];
    }

    public function fieldsRequired(): array {
	return [
	    'name',
	    'description'
	];
    }

    public function fieldsHelp(): array {
	return [];
    }

}