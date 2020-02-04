<?php

namespace IdnoPlugins\Courseware\Pages\Admin;

use Idno\Common\Page;
use Idno\Core\Idno;

class Courseware extends Page {
    
    public function getContent() {
	
	
	$this->adminGatekeeper();
	
	$t = Idno::site()->template();
	
	$title = Idno::site()->language()->_('Courseware');
	
	
	echo $t->__(array('body' => $t->draw('admin/Courseware/home'), 'title' => $title))->drawPage();
	
    }
}

