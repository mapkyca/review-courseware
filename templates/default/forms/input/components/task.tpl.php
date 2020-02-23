<?php

if (is_array($vars['value'])) {
    $vars['value'] = array_filter($vars['value']);
}

if ($vars['value']) {
    $decoded = json_decode($vars['value']);
}

?>

<div class="task-item" style="margin-bottom: 15px;">
    
    <textarea style="display:none;" name="<?= $vars['name']; ?>"><?php if (!empty($vars['value']) && !empty($decoded)) echo $vars['value']; ?></textarea>
    
    <input type="hidden" class="task_id" value="<?= trim($decoded->task_id)??""; ?>" />
    
    <input type="text" class="name form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('Name'); ?>" value="<?= trim($decoded->name)??""; ?>"/>
    
    <?php unset ($this->vars['name']);     ?>
    
    <?= $this->__([
    'placeholder' => \Idno\Core\Idno::site()->language()->_('Start date and time'),
    'value' => trim($decoded->start)??"",
    'class' => 'start form-control'])->draw('forms/input/datetime-local'); ?>
    
    <?php unset ($this->vars['name']);     ?>
    
    <?= $this->__([
    'placeholder' => \Idno\Core\Idno::site()->language()->_('End date and time'),
    'value' => trim($decoded->end)??"",
    'class' => 'end form-control'])->draw('forms/input/datetime-local'); ?>
    
    <?php unset ($this->vars['name']);     ?>
    
    <input type="text" class="description form-control" placeholder="<?= \Idno\Core\Idno::site()->language()->_('Description'); ?>" value="<?= trim($decoded->description)??""; ?>" />
    
    <hr>
</div>
<?php
unset ($this->vars['value']); 
?>