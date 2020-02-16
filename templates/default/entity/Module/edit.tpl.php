<div class="module-form">
    <?php
    if (empty($vars['object'])) {
	?>
    <h2><?= \Idno\Core\Idno::site()->language()->_('Add a New Module'); ?></h2>
    <?php
    } else {
	?>
    <h2><?= \Idno\Core\Idno::site()->language()->_('Edit module %s', [$vars['object']->name]); ?></h2>
    <?php
    } ?>
    
    <form action="<?php echo $vars['object'] ? $vars['object']->getEditURL() : \Idno\Core\Idno::site()->config()->getDisplayURL() . 'admin/courseware/module/edit/'; ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="course_id" value="<?= $vars['object']->course_id??\Idno\Core\Input::getInput('course_id'); ?>" />
<?php

    echo $this->__([
	'form' => $vars['object']->fields(),
	'defaults' => $vars['object']->fieldsDefaults(),
	'required' => $vars['object']->fieldsRequired(),
	'labels' => $vars['object']->fieldsLabels(),
	'placeholders' => $vars['object']->fieldsPlaceholders(),
	'values' => $vars['object']
    ])->draw('forms/input/form-list');
?>
	<?php echo $this->draw('content/extra'); ?>
	<?php echo $this->draw('content/access'); ?>
	
	<div class="button-bar row">
	    <?php echo \Idno\Core\Idno::site()->actions()->signForm('/admin/courseware/module/edit') ?>
	    <input type="button" class="btn btn-cancel" value="<?php echo \Idno\Core\Idno::site()->language()->_('Cancel'); ?>" onclick="hideContentCreateForm();"/>
	    <input type="submit" class="btn btn-primary" value="<?php echo \Idno\Core\Idno::site()->language()->_('Save'); ?>"/>
	    
	    
	</div>
	
	<div class="row" style="margin-top:20px;">
	    <?php
	    if (!empty($vars['object'])) {
		/*?>
	    
	    <a href="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>schedule/edit" class="btn btn-lg btn-primary"><?php echo \Idno\Core\Idno::site()->language()->_('Add a Schedule'); ?></a>
	    
	    <a href="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>module/edit" class="btn btn-lg btn-primary"><?php echo \Idno\Core\Idno::site()->language()->_('Add a Module'); ?></a>
	    
	    <?php */
	    }
	    ?>
	</div>
    </form>
</div>

<?php echo $this->draw('entity/edit/footer');?>