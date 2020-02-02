<?php

namespace IdnoPlugins\Courseware;

class Main extends \Idno\Common\Plugin {

    function registerPages() {
	
	\Idno\Core\Idno::site()->routes()->addRoute('/admin/courseware/?', Pages\Courseware::class);
	
	foreach ([
	    'Course', 'Module', 'Shedule', 'Task'
	] as $entity) {
	    $lower = strtolower($entity);
	    \Idno\Core\Idno::site()->routes()->addRoute("/{$lower}/edit/?", "\\IdnoPlugins\\Courseware\\Pages\\Entities\\{$entity}\\Edit");
	    \Idno\Core\Idno::site()->routes()->addRoute("/{$lower}/edit/([A-Za-z0-9]+)/?", "\\IdnoPlugins\\Courseware\\Pages\\Entities\\{$entity}\\Edit");
            \Idno\Core\Idno::site()->routes()->addRoute("/{$lower}/delete/([A-Za-z0-9]+)/?", \Idno\Pages\Entity\Delete::class);
	}
    }

    function registerTranslations() {

	\Idno\Core\Idno::site()->language()->register(
		new \Idno\Core\GetTextTranslation(
			'courseware', dirname(__FILE__) . '/languages/'
		)
	);
    }

}
