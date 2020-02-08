<?php

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

<div class="course">
    
    <div class="col-md-offset-2 col-md-8">
	
	<div class="title">
	    <h1 class="p-name"><?= $vars['object']->name; ?></h1>
	</div>
	
	<div class="image">
	    <img class="u-featured" src="<?php echo $this->makeDisplayURL($src) ?>" class="u-photo"
               alt="<?php echo htmlentities(strip_tags($vars['object']->alt), ENT_QUOTES, 'UTF-8'); ?>"/>
	</div>
	
	<div class="description p-summary">
	    <?= $vars['object']->description; ?>
	</div>
	
	
	<div class="objectives">
	    
	    
	    
	    /// objectives
	    
	    
	    
	    
	</div>
	
	
    </div>
    
    <div class="col-md-2">
	
	
	modules
	
    </div>
    
    
</div>