<?php

if (is_array($vars['value'])) {
    $vars['value'] = array_filter($vars['value']);
}

if ($vars['value']) {
    $decoded = json_decode($vars['value']);
}

?>

<div class="reading-item" style="margin-bottom: 15px;">
    
    <textarea style="display:none;" name="<?= $vars['name']; ?>"><?php if (!empty($vars['value'])) echo $vars['value']; ?></textarea>
    
    
    <input type="hidden" class="reading_id"value="<?= trim($decoded->reading_id)??""; ?>" />
    
    <input type="url" class="url form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('URL'); ?>" value="<?= trim($decoded->url)??""; ?>" /> 
    
    <input type="text" class="title form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('Title'); ?>" value="<?= trim($decoded->title)??""; ?>"/>
    
    <input type="text" class="author form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('Author'); ?>" value="<?= trim($decoded->author)??""; ?>" />
    
    <input type="text" class="description form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('Description'); ?>" value="<?= trim($decoded->description)??""; ?>" />
    
    <hr>
</div>
<?php
unset ($this->vars['value']); 
?>