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
?>

<div class="module">
    
    <div class="col-md-12 panel">
	
	<div class="title panel-heading">
	    <h1 class="p-name"><?= $vars['object']->name; ?></h1>
	</div>
	
	<div class="panel-body">
	    <div class="image">
		<img class="u-featured" src="<?php echo $this->makeDisplayURL($src) ?>" class="u-photo"
		   alt="<?php echo htmlentities(strip_tags($vars['object']->alt), ENT_QUOTES, 'UTF-8'); ?>"/>
	    </div>

	    <div class="description p-summary">
		<?= $this->__(['value' => $vars['object']->description, 'object' => $vars['object']])->draw('forms/output/richtext'); ?>
	    </div>
	</div>
	
	
	
	
	readings
	
	
	tasks
	

	Assignments...?
	
    </div>
    
    
</div>