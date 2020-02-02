<?php

namespace IdnoPlugins\Courseware;

class Main {

    function registerPages() {
	
    }

    function registerTranslations() {

	\Idno\Core\Idno::site()->language()->register(
		new \Idno\Core\GetTextTranslation(
			'courseware', dirname(__FILE__) . '/languages/'
		)
	);
    }

}
