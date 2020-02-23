<?php

if (is_array($vars['value'])) {
    $vars['value'] = array_filter($vars['value']);
}

if ($vars['value']) {
    $decoded = json_decode($vars['value']);
}

?>

<div class="event-item" style="margin-bottom: 15px;">
    
    <textarea style="display:none;" name="<?= $vars['name']; ?>"><?php if (!empty($vars['value']) && !empty($decoded)) echo $vars['value']; ?></textarea>
    
    <input type="hidden" class="event_id" value="<?= trim($decoded->event_id)??""; ?>" />
    
    <input type="text" class="name form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('Name'); ?>" value="<?= trim($decoded->name)??""; ?>"/>
    
    <?= $this->__([
    'placeholder' => \Idno\Core\Idno::site()->language()->_('Start date and time'),
    'value' => trim($decoded->start)??"",
    'class' => 'start form-control'])->draw('forms/input/datetime-local'); ?>
    
    <?= $this->__([
    'placeholder' => \Idno\Core\Idno::site()->language()->_('End date and time'),
    'value' => trim($decoded->end)??"",
    'class' => 'end form-control'])->draw('forms/input/datetime-local'); ?>
   
    <hr>
</div>
<?php
unset ($this->vars['value']); 
?>