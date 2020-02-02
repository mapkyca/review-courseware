<?php

namespace IdnoPlugins\Courseware;

class Main extends \Idno\Common\Plugin {

    function registerPages() {
	
    }

    function registerTranslations() {

	\Idno\Core\Idno::site()->language()->register(
		new \Idno\Core\GetTextTranslation(
			'reviewcourseware', dirname(__FILE__) . '/languages/'
		)
	);
    }

}
