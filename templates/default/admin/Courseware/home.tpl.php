<div class="row">

    <div class="col-md-10 col-md-offset-1">
                <?php echo $this->draw('admin/menu');?>

        <h1><?php echo \Idno\Core\Idno::site()->language()->_('Courseware'); ?></h1>

      
    </div>

</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">

	<table id="courses">
	    <thead>
		<tr>
		    <th>Course Name</th>
		    <th>Action</th>
		</tr>
	    </thead>
	    <tbody>
	<?php
	$courses = \IdnoPlugins\Courseware\Entities\Course::get([], [], PHP_INT_MAX); 
	
	if ($courses) {
	    foreach ($courses as $course) {
		?>
		
		<tr>
		    <td><a href="<?= $course->getUrl(); ?>"><?= $course->name; ?></a></td>
		    <td style="width: 20%;">
			<?php if ($course->canEdit()) { ?>
			    <a href="<?= $course->getEditUrl() ?>" class="btn btn-primary"><?= \Idno\Core\Idno::site()->language()->_('Edit'); ?></a>
			    <?= $this->__([
				'url' => $course->getDeleteUrl(),
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
</div>

<div class="row" style="margin-top:20px;">
    <div class="col-md-10 col-md-offset-1">

	<a href="<?= Idno\Core\Idno::site()->config()->getDisplayURL(); ?>course/edit" class="btn btn-lg btn-primary"><?= \Idno\Core\Idno::site()->language()->_('New Course'); ?></a>
	
    </div>
</div>
<script>

    $(document).ready(function() {
	$('#courses').DataTable({
	    "language": {
		"emptyTable":     "No courses available"
	    }
	});
    } );

</script>