<?php

namespace IdnoPlugins\Courseware;

class Main extends \Idno\Common\Plugin {

    function registerPages() {
	
	\Idno\Core\Idno::site()->routes()->addRoute('/courseware/codeofconduct/?', Pages\COC::class);
	
	\Idno\Core\Idno::site()->routes()->addRoute('/admin/courseware/?', Pages\Admin\Courseware::class);
	
	foreach ([
	    'Course', 'Module', //'Schedule', 'Task'
	] as $entity) {
	    $lower = strtolower($entity);
	    \Idno\Core\Idno::site()->routes()->addRoute("/{$lower}/view/([A-Za-z0-9]+)/?", "\\IdnoPlugins\\Courseware\\Pages\\Entities\\{$entity}\\View");
	    \Idno\Core\Idno::site()->routes()->addRoute("/admin/courseware/{$lower}/edit/?", "\\IdnoPlugins\\Courseware\\Pages\\Entities\\{$entity}\\Edit");
	    \Idno\Core\Idno::site()->routes()->addRoute("/admin/courseware/{$lower}/edit/([A-Za-z0-9]+)/?", "\\IdnoPlugins\\Courseware\\Pages\\Entities\\{$entity}\\Edit");
            \Idno\Core\Idno::site()->routes()->addRoute("/{$lower}/delete/([A-Za-z0-9]+)/?", \Idno\Pages\Entity\Delete::class);
	    
	}
	
	// Course schedule
	\Idno\Core\Idno::site()->routes()->addRoute('/admin/courseware/course/edit/([A-Za-z0-9]+)/schedule/?', Pages\Admin\Schedule::class);
	
	//\Idno\Core\Idno::site()->routes()->addRoute("course/([A-Za-z0-9]+)/?", IdnoPlugins\Courseware\Pages\Entities\Feed::class);
	\Idno\Core\Idno::site()->routes()->addRoute("course/view/([A-Za-z0-9]+)/([a-z]+)/?", \IdnoPlugins\Courseware\Pages\Entities\Feed::class);
	
	
	\Idno\Core\Idno::site()->template()->extendTemplate('admin/menu/items', 'admin/Courseware/menu');
	\Idno\Core\Idno::site()->template()->extendTemplate('shell/css', 'shell/Courseware/css');
	\Idno\Core\Idno::site()->template()->extendTemplate('settings-shell/css', 'settings-shell/Courseware/css');
	\Idno\Core\Idno::site()->template()->extendTemplate('settings-shell/javascript', 'settings-shell/Courseware/javascript');
	
	\Idno\Core\Idno::site()->template()->prependTemplate('shell/toolbar/links', 'entity/Course/toolbar', true);
    }

    function registerTranslations() {

	\Idno\Core\Idno::site()->language()->register(
		new \Idno\Core\GetTextTranslation(
			'courseware', dirname(__FILE__) . '/languages/'
		)
	);
    }

}
