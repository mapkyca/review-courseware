<?php

namespace IdnoPlugins\Courseware\Pages;

class COC extends \Idno\Common\Page {

    function getContent() {

	$t = \Idno\Core\Idno::site()->template();
	$t->__(array(

	    'title'       => 'Code of Conduct',
	    'body'        => $t->draw('pages/Courseware/codeofconduct'),

	))->drawPage();
    }

}
