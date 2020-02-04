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
	    'name' => 'Course Name',
	    'image' => 'Upload Image',
	    'alt' => 'Alt',
	    'description' => 'Course Description',
	    'objectives' => 'Objectives',
	    'codeofconduct' => 'Do you want a code of conduct?',
	];
    }

    public function fieldsPlaceholders(): array {
	return [];
    }

    public function fieldsRequired(): array {
	return [
	    'name',
	    'image',
	    'description'
	];
    }

    public function fieldsHelp(): array {
	return [];
    }

}