<div class="course-form">
    <h2><?= \Idno\Core\Idno::site()->language()->_('Add a Schedule'); ?></h2>
    
    <form action="<?php echo $vars['object']->getURL() ?>" method="post" enctype="multipart/form-data">
	
	<h3><?= \Idno\Core\Idno::site()->language()->_('Add a Task'); ?></h3>
	
	...
	
	<h3><?= \Idno\Core\Idno::site()->language()->_('Add an Event'); ?></h3>
	
	...

	<?php echo $this->draw('content/extra'); ?>
	<?php echo $this->draw('content/access'); ?>
	
	<div class="button-bar row">
	    <?php echo \Idno\Core\Idno::site()->actions()->signForm('/course/edit') ?>
	    <input type="button" class="btn btn-cancel" value="<?php echo \Idno\Core\Idno::site()->language()->_('Cancel'); ?>" onclick="hideContentCreateForm();"/>
	    <input type="submit" class="btn btn-primary" value="<?php echo \Idno\Core\Idno::site()->language()->_('Save'); ?>"/>
	    
	    
	</div>

    </form>
</div>

<?php echo $this->draw('entity/edit/footer');?>