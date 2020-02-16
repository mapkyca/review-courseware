<div id="<?= $vars['id']; ?>-control">
<?php 

    $vars['class'] .= ' form-control ';
    $vars['name'] .= '[]';

    if (!empty($vars['value'])) {
	foreach($vars['value'] as $value) {
	    if (!empty($value)) { 
		echo $this->__(array_merge($vars, ['value' => $value]))->draw('forms/input/components/reading'); 
	    }
	}
    }
    
    unset ($vars['value']);
    
    echo $this->__($vars)->draw('forms/input/components/reading'); 

?>
</div>

<p>
    <small><a id="<?= $vars['id']; ?>-add" href="#"
	      onclick="$('#<?= $vars['id']; ?>-control').append('<?= htmlspecialchars(str_replace("\n",' ', $this->__($vars)->draw('forms/input/components/reading'))) ?>'); activate_<?= str_replace('-','_', $vars['id']); ?>(); return false;"><i class="fa fa-plus"></i>
	    <?php echo \Idno\Core\Idno::site()->language()->_('Add another reading'); ?></a></small>
</p>
<script>
    
    function activate_<?= str_replace('-','_', $vars['id']); ?>() {
	$('#<?= $vars['id']; ?>-control .reading-item input').change(function(e){
	    console.log('updating');
	    $(this).closest('.reading-item').find('textarea').val(
		    JSON.stringify({
			reading_id: $(this).closest('.reading-item').find('.reading_id').val(),
			url: $(this).closest('.reading-item').find('.url').val(),
			title: $(this).closest('.reading-item').find('.title').val(),
			author: $(this).closest('.reading-item').find('.author').val(),
			description: $(this).closest('.reading-item').find('.description').val()
		    })
	    );

	});
    }
    
    activate_<?= str_replace('-','_', $vars['id']); ?>();

</script>