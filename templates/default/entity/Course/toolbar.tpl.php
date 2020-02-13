<?php
$object = $vars['object'];

if ($object instanceof IdnoPlugins\Courseware\Entities\Course && \Idno\Core\Idno::site()->currentPage()->isPermalink()) {
    ?>

<!--    <li>
        <ul class="nav"> -->
	    <?php if ($object->codeofconduct == 'y' || empty($object->codeofconduct)) { ?>
	    <li>
		<a href="<?php echo $object->getURL() ?>"><?= \Idno\Core\Idno::site()->language()->_('Code of Conduct'); ?></a>
	    </li>
	    <?php } ?>
	    
	    <li>
		<a href="<?= $object->getUrl(); ?>schedule/"><?= \Idno\Core\Idno::site()->language()->_('Schedule'); ?></a>
	    </li>
	    
	    <li>
		<a href="<?= $object->getUrl(); ?>module/"><?= \Idno\Core\Idno::site()->language()->_('Modules'); ?></a>
	    </li>
<!--        </ul>
    </li>
-->
    <?php
}