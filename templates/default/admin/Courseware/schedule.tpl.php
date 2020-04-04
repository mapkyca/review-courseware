<div class="schedule-form">
    <h2><?= \Idno\Core\Idno::site()->language()->_('Add a Schedule'); ?></h2>
    
    <form action="<?php echo \Idno\Core\Idno::site()->currentPage()->currentUrl(); ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="course_id" value="<?= $vars['course']->getID(); ?>" />
	
	
	<h3><?= \Idno\Core\Idno::site()->language()->_('Add a Task'); ?></h3>

	<?php
	
	    echo $this->__([
		'form' => ['tasks' => 'tasks'],
		'defaults' => [],
		'required' => [],
		'labels' => [],
		'placeholders' => [],
		'values' => ['tasks' => $vars['course']->tasks]
	    ])->draw('forms/input/form-list');
	?>
	
	
	
	
	
	<h3><?= \Idno\Core\Idno::site()->language()->_('Add an Event'); ?></h3>
	
	<?php

	    echo $this->__([
		'form' => ['events' => 'events'],
		'defaults' => [],
		'required' => [],
		'labels' => [],
		'placeholders' => [],
		'values' => ['events' => $vars['course']->events]
	    ])->draw('forms/input/form-list');
	?>

	
	<div class="button-bar row">
	    <?php echo \Idno\Core\Idno::site()->actions()->signForm('/admin/courseware/course/edit/' . $vars['course']->getID(). '/schedule/'); ?>
	    <input type="button" class="btn btn-cancel" value="<?php echo \Idno\Core\Idno::site()->language()->_('Cancel'); ?>" onclick="hideContentCreateForm();"/>
	    <input type="submit" class="btn btn-primary" value="<?php echo \Idno\Core\Idno::site()->language()->_('Save'); ?>"/>
	    
	    
	</div>
	
    </form>
</div>

<?php echo $this->draw('entity/edit/footer');?>