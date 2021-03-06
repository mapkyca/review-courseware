<?php

$owner = $vars['object']->getOwner();
$attachments = $vars['object']->getAttachments();

$attachment = $attachments[0];

$mainsrc = $attachment['url'];

$filename = "";
if (!empty($attachment['filename']))
    $filename = $attachment['filename'];
if (!empty($vars['object']->thumbs_large) && !empty($vars['object']->thumbs_large[$filename])) {
    $src = $vars['object']->thumbs_large[$filename]['url'];
    // Old style
} else if (!empty($vars['object']->thumbnail_large)) {
    $src = $vars['object']->thumbnail_large;
} else if (!empty($vars['object']->thumbnail)) { // Backwards compatibility
    $src = $vars['object']->thumbnail;
} else {
    $src = $mainsrc;
}

// Patch to correct certain broken URLs caused by https://github.com/idno/known/issues/526
$src = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\Idno::site()->config()->getDisplayURL(), $src);
$mainsrc = preg_replace('/^(https?:\/\/\/)/', \Idno\Core\Idno::site()->config()->getDisplayURL(), $mainsrc);

$src = \Idno\Core\Idno::site()->config()->sanitizeAttachmentURL($src);
$mainsrc = \Idno\Core\Idno::site()->config()->sanitizeAttachmentURL($mainsrc);


if (\Idno\Core\Idno::site()->currentPage()->isPermalink()) {
?>

<div class="course">
    
    <div class="col-md-9 panel">
	
	<div class="title panel-heading">
	    <h1 class="p-name"><a href="<?php echo $vars['object']->getDisplayURL(); ?>"><?= $vars['object']->name; ?></a></h1>
	</div>
	
	<div class="panel-body">
	    <?php if (!empty($attachment)) { ?>
	    <div class="image">
		<img class="u-featured" src="<?php echo $this->makeDisplayURL($src) ?>" class="u-photo"
		   alt="<?php echo htmlentities(strip_tags($vars['object']->alt), ENT_QUOTES, 'UTF-8'); ?>"/>
                
                <?php 
                if (!empty($vars['object']->attribution)) {
                    ?>
                <div class="attribution">
                    <small><?= $vars['object']->attribution; ?></small>
                </div>
                <?php
                }
                ?>
	    </div>
	    <?php } ?>

	    <div class="description p-summary">
		<?= $this->__(['value' => $vars['object']->description, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
	    </div>
	</div>
	
	<div class="objectives">
            
            <h2><?= \Idno\Core\Idno::site()->language()->_('Objectives'); ?></h2>
	    
	    <?php
	    
	    if ($vars['object']->objectives) {
		
		foreach ($vars['object']->objectives as $objective) {
	    
		    ?>
	    
	    <div class="objective col-md-4 panel" >
		
		<p>
		    <?= htmlentities($objective, ENT_QUOTES, 'UTF-8'); ?>
		</p>
		
	    </div>
	    	    
		    <?php
		    
		}
		
	    }
	    
	    ?>
	    
	</div>
	
	
    </div>
    
    <div class="col-md-3 sidebar">
	
	<div class="author">
	    <div class="owner p-author h-card visible-md visible-lg">
		<p>
		    <a href="<?php echo $owner->getDisplayURL() ?>" class="u-url icon-container">
			<img class="u-photo" src="<?php echo $owner->getIcon() ?>"/></a><br/>
		    <a href="<?php echo $owner->getDisplayURL() ?>" class="p-name u-url fn"><?php echo htmlentities(strip_tags($owner->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a>
		</p>
	    </div>
	</div>
	
	<?php
	
	$modules = IdnoPlugins\Courseware\Entities\Module::get(['course_id' => $vars['object']->getID()], [], PHP_INT_MAX);
	
	if ($modules) {
	?>
	<div class="panel modules">
	    <div class="panel-heading">
		<h2><?= \Idno\Core\Idno::site()->language()->_('Modules'); ?></h2>
	    </div>
	    <div class="panel-body">
		<ol>
		    <?php
		    foreach ($modules as $module) {
		    ?>

		    <li>
			<a href="<?= $module->getUrl(); ?>" class="h-event"><?= $module->getTitle(); ?></a>
		    </li>
		    <?php
		    }

		    ?>
		</ol>
	    </div>
	</div>
	<?php
	}
	?>
	
	<?php
	
	$events = IdnoPlugins\Event\Event::get(['course_id' => $vars['object']->getID()], [], PHP_INT_MAX);
	
	if ($events) {
	?>
	<div class="panel events">
	    <div class="panel-heading">
		<h2><?= \Idno\Core\Idno::site()->language()->_('Events'); ?></h2>
	    </div>
	    <div class="panel-body">
		<ol>
		    <?php
		    foreach ($events as $event) {
		    ?>

		    <li>
			<a href="<?= $event->getUrl(); ?>" class="h-event"><?= $event->getTitle(); ?></a>
		    </li>
		    <?php
		    }

		    ?>
		</ol>
	    </div>
	</div>
	<?php
	}
	?>
	
	
    </div>
    
    
</div>

<?php } else {
  
    ?>
<div class="course">
    
    <div class="col-md-12 panel">
	
	<div class="title panel-heading">
	    <h1 class="p-name"><a href="<?php echo $vars['object']->getDisplayURL(); ?>"><?= $vars['object']->name; ?></a></h1>
	</div>
	
	<div class="description p-summary">
	    <?= $this->__(['value' => $vars['object']->description, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
	</div>

    </div>
    
</div>

<?php
    
}
?>