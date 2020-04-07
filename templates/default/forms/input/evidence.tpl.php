<div id="<?= $vars['id']; ?>-control">
<?php 

    $vars['class'] .= ' form-control ';
    $vars['name'] .= '[]';

    if (!empty($vars['value'])) {
	foreach($vars['value'] as $value) {
	    if (!empty($value)) {
		echo $this->__(array_merge($vars, ['value' => $value]))->draw('forms/input/input'); 
	    }
	}
    }
    
    unset ($vars['value']);
    
    echo $this->__($vars)->draw('forms/input/input'); 

?>
</div>

<p>
    <small><a id="<?= $vars['id']; ?>-add" href="#"
	      onclick="$('#<?= $vars['id']; ?>-control').append('<?= htmlspecialchars(str_replace("\n",' ', $this->__($vars)->draw('forms/input/input'))) ?>'); return false;"><i class="fa fa-plus"></i>
	    <?php echo \Idno\Core\Idno::site()->language()->_('Add evidence'); ?></a></small>
</p>