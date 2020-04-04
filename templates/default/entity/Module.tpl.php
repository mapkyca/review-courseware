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

<div class="module">
    
    <div class="col-md-12 panel">
	
	<div class="title panel-heading">
	    <h1 class="p-name"><a href="<?php echo $vars['object']->getDisplayURL(); ?>"><?= $vars['object']->name; ?></a></h1>
	</div>
	
	<div class="panel-body">
	    <?php if (!empty($attachment)) { ?>
	    <div class="image">
		<img class="u-featured" src="<?php echo $this->makeDisplayURL($src) ?>" class="u-photo"
		   alt="<?php echo htmlentities(strip_tags($vars['object']->alt), ENT_QUOTES, 'UTF-8'); ?>"/>
	    </div>
	    <?php } ?>

	    <div class="description p-summary">
		<?= $this->__(['value' => $vars['object']->description, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
	    </div>
	</div>
	
	
	
	<?php 

	$readings = IdnoPlugins\Like\Like::get(['module_id' => $vars['object']->getID()]);
	if ($readings) {

	?>
	<div class="readings row">
	    <h2><?= \Idno\Core\Idno::site()->language()->_('The Readings'); ?></h2>
	    
	    <?php 
	    foreach ($readings as $reading) {
		?>
		
	    <div class="reading col-md-6">
		<h3 class="idno-bookmark"><a href="<?php echo $reading->body; ?>" class="<?php echo $class ?> p-name"
		    target="_blank"><?php echo $this->parseURLs(htmlentities(strip_tags($reading->title))) ?></a>
		</h3>
                <p class="description"><?php echo $this->parseURLs(htmlentities(strip_tags($reading->description))) ?></p>
		<?php echo $this->__(['object' => $reading])->draw('entity/content/embed'); ?>
	    </div>
		
		<?php
	    }
	    ?>
	</div>
	<?php 
	}
	?>
	
	
	<?php 

	$tasks = \IdnoPlugins\Event\Event::get(['module_id' => $vars['object']->getID()]);
	if ($tasks) {

	?>
	<div class="tasks row">
	    <h2><?= \Idno\Core\Idno::site()->language()->_('The Tasks'); ?></h2>
	    
	    <?php 
	    foreach ($tasks as $task) {
		
		$starttime = strtotime($task->starttime);
		$endtime = strtotime($task->endtime);
		$timeformat = 'l, jS F Y h:i A';
		?>
		
	    <div class="task col-md-6">
		<h3 class="p-name"><a href="<?php echo $task->getDisplayURL() ?>" class="u-url"><?php echo htmlentities(strip_tags($task->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a></h3>
		
		<p class="p-summary">
		    <strong><?php echo htmlentities(strip_tags($task->summary), ENT_QUOTES, 'UTF-8'); ?></strong>
		</p>
		
		<p>
		    <time class="dt-start"
			  datetime="<?php echo date('c', $starttime) ?>"><?php echo date($timeformat, $starttime)?></time>
		    
		    - <time class="dt-end"
			  datetime="<?php echo date('c', $endtime) ?>"><?php echo date('h:i A', $endtime);?></time><?php
		    

		    ?>
		</p>
	    </div>
		
		<?php
	    }
	    ?>
	</div>
	<?php 
	}
	?>
	
	
	<div class="assessment row">
	    <h2><?= \Idno\Core\Idno::site()->language()->_('Assessment'); ?></h2>
	    
	    <div class="task col-md-6">
		<h3><?= \Idno\Core\Idno::site()->language()->_('Criteria'); ?></h3>
		
		<p class="p-x-criteria">
		    <?php echo htmlentities(strip_tags($vars['object']->criteria), ENT_QUOTES, 'UTF-8'); ?>
		</p>
		
	    </div>	
	    
	    <div class="task col-md-6">
		<h3><?= \Idno\Core\Idno::site()->language()->_('Evidence'); ?></h3>
		
		<p class="p-x-evidence">
		    <?php echo htmlentities(strip_tags($vars['object']->evidence), ENT_QUOTES, 'UTF-8'); ?>
		</p>
		
	    </div>	
	</div>
	
    </div>
    
</div>
<?php } else {
    
    ?>

<div class="module">
    
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