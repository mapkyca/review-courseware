<div class="course-form">
    
    <?php
    if (empty($vars['object'])) {
	?>
    <h2><?= \Idno\Core\Idno::site()->language()->_('Add a New Course'); ?></h2>
    <?php
    } else {
	?>
    <h2><?= \Idno\Core\Idno::site()->language()->_('Edit course %s', [$vars['object']->name]); ?></h2>
    <?php
    } ?>
    
    <form action="<?php echo $vars['object'] ? $vars['object']->getEditURL() : \Idno\Core\Idno::site()->config()->getDisplayURL() . 'admin/courseware/course/edit/';?>" method="post" enctype="multipart/form-data">
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
	<?php
	    if (!empty($vars['object'])) {
		?>
	
	<div class="row" style="margin-top:20px;">
	    <div class="col-sm-12 col-md-2">
		<label>
		    <?= \Idno\Core\Idno::site()->language()->_('Modules'); ?>
		</label> 
	    </div>
	    <div class="col-sm-12 col-md-6">

		<table id="modules">
		    <thead>
			<tr>
			    <th>Module</th>
			    <th>Action</th>
			</tr>
		    </thead>
		    <tbody>
		    <?php
		    $modules = \IdnoPlugins\Courseware\Entities\Module::get(['course_id' => $vars['object']->getID()], [], PHP_INT_MAX); 

		    if ($modules) {
			foreach ($modules as $module) {
			    ?>

			    <tr>
				<td><a href="<?= $module->getUrl(); ?>"><?= $module->name; ?></a></td>
				<td style="width: 20%;">
				    <?php if ($module->canEdit()) { ?>
					<a href="<?= $module->getEditUrl() ?>" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Edit'); ?></a>
					<?= $this->__([
					    'url' => $module->getDeleteUrl(),
					    'label' => \Idno\Core\Idno::site()->language()->_('Delete'),
					    'class' => 'btn btn-danger',
					    'confirm' => true,
					    'confirm-text' => \Idno\Core\Idno::site()->language()->_('Are you sure you want to remove this course?')
					])->draw('forms/link'); ?>
				    <?php } ?>
				</td>
			    </tr>

			    <?php
			}
		    }
		    ?>
		    </tbody>
		</table>


	    </div>
	    <div class="col-sm-12 col-md-4">
		<p class="config-desc"></p>
	    </div>
	</div>



	<div class="row" style="margin-top:20px;">
	    <div class="col-sm-12 col-md-2">
		<label>
		    <?= \Idno\Core\Idno::site()->language()->_('Tasks and Events'); ?>
		</label> 
	    </div>
	    <div class="col-sm-12 col-md-6">

		<table id="schedule">
		    <thead>
			<tr>
			    <th>Title</th>
			    <th>Start date</th>
			    <th>End date</th>
			    <th>Action</th>
			</tr>
		    </thead>
		    <tbody>
		    <?php
		    $events = \IdnoPlugins\Event\Event::get(['course_id' => $vars['object']->getID()], [], PHP_INT_MAX); 

		    if ($events) {
			foreach ($events as $event) {
			    
			    $starttime = strtotime($event->starttime);
			    $endtime = strtotime($event->endtime);
			    $timeformat = 'l, jS F Y h:i A';
			    ?>

			    <tr>
				<td><a href="<?= $event->getUrl(); ?>"><?= $event->getTitle(); ?></a></td>
				<td><time class="dt-start" datetime="<?php echo date('c', $starttime) ?>"><?php echo date($timeformat, $starttime)?></time></td>
				<td><time class="dt-end" datetime="<?php echo date('c', $endtime) ?>"><?php echo date('h:i A', $endtime);?></time></td>
				<td style="width: 20%;">
				    <?php if ($module->canEdit()) { ?>
					<a href="<?= $module->getEditUrl() ?>" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Edit'); ?></a>
					<?= $this->__([
					    'url' => $module->getDeleteUrl(),
					    'label' => \Idno\Core\Idno::site()->language()->_('Delete'),
					    'class' => 'btn btn-danger',
					    'confirm' => true,
					    'confirm-text' => \Idno\Core\Idno::site()->language()->_('Are you sure you want to remove this course?')
					])->draw('forms/link'); ?>
				    <?php } ?>
				</td>
			    </tr>

			    <?php
			}
		    }
		    ?>
		    </tbody>
		</table>


	    </div>
	    <div class="col-sm-12 col-md-4">
		<p class="config-desc"></p>
	    </div>
	</div>	
	<?php
	    }
	    ?>
	
	<?php echo $this->draw('content/extra'); ?>
	<?php echo $this->draw('content/access'); ?>
	
	
	
	<div class="row" style="margin-top:20px;">
	    <?php
	    if (!empty($vars['object'])) {
		?>
	    
	    <a href="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>admin/courseware/course/edit/<?= $vars['object']->getID(); ?>/schedule/" class="btn btn-lg btn-primary"><?php echo \Idno\Core\Idno::site()->language()->_('Add a Schedule'); ?></a>
	    
	    <a href="<?php echo \Idno\Core\Idno::site()->config()->getDisplayURL() ?>admin/courseware/module/edit?course_id=<?= $vars['object']->getID(); ?>" class="btn btn-lg btn-primary"><?php echo \Idno\Core\Idno::site()->language()->_('Add a Module'); ?></a>
	    
	    <?php
	    }
	    ?>
	</div>
	
	
	<div class="button-bar row" style="margin-top:20px;">
	    <?php echo \Idno\Core\Idno::site()->actions()->signForm('/admin/courseware/course/edit') ?>
	    <input type="button" class="btn btn-cancel" value="<?php echo \Idno\Core\Idno::site()->language()->_('Cancel'); ?>" onclick="hideContentCreateForm();"/>
	    <input type="submit" class="btn btn-primary" value="<?php echo \Idno\Core\Idno::site()->language()->_('Save'); ?>"/>
	    
	    
	</div>
    </form>
</div>
<script>

    $(document).ready(function() {
	$('#modules').DataTable({
	    "language": {
		"emptyTable":     "<?= \Idno\Core\Idno::site()->language()->_('No modules available'); ?>"
	    }
	});
	
	$('#schedule').DataTable({
	    "language": {
		"emptyTable":     "<?= \Idno\Core\Idno::site()->language()->_('No schedule events available'); ?>"
	    }
	});
    } );

</script>

<?php echo $this->draw('entity/edit/footer');?>