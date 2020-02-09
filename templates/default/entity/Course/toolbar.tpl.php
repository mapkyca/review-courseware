<?php
$object = $vars['object'];

if ($object instanceof IdnoPlugins\Courseware\Entities\Course && \Idno\Core\Idno::site()->currentPage()->isPermalink()) {
    ?>

<!--    <li>
        <ul class="nav"> -->
	    <li>
		<a href="<?php echo $object->getURL() ?>"><?= \Idno\Core\Idno::site()->language()->_('Code of Conduct'); ?></a>
	    </li>
	    
	    <li>
		<a href="<?php echo $object->getURL() ?>"><?= \Idno\Core\Idno::site()->language()->_('Schedule'); ?></a>
	    </li>
	    
	    <li>
		<a href="<?php echo $object->getURL() ?>"><?= \Idno\Core\Idno::site()->language()->_('Modules'); ?></a>
	    </li>
<!--        </ul>
    </li>
-->
    <?php
}