<div id="<?= $vars['id']; ?>-control">
<?php 

    $vars['class'] .= ' form-control ';
    $vars['name'] .= '[]';

    if (!empty($vars['value'])) {
	foreach($vars['value'] as $value) {
	    if (!empty($value)) { 
		echo $this->__(array_merge($vars, ['value' => $value]))->draw('forms/input/components/event'); 
	    }
	}
    }
    
    unset ($vars['value']);
    
    echo $this->__($vars)->draw('forms/input/components/event'); 

?>
</div>

<p>
    <small><a id="<?= $vars['id']; ?>-add" href="#"
	      onclick="$('#<?= $vars['id']; ?>-control').append('<?= htmlspecialchars(str_replace("\n",' ', $this->__($vars)->draw('forms/input/components/event'))) ?>'); activate_<?= str_replace('-','_', $vars['id']); ?>(); return false;"><i class="fa fa-plus"></i>
	    <?php echo \Idno\Core\Idno::site()->language()->_('Add another event'); ?></a></small>
</p>
<script>
    
    function activate_<?= str_replace('-','_', $vars['id']); ?>() {
	$('#<?= $vars['id']; ?>-control .event-item input').change(function(e){
	    console.log('updating');
	    $(this).closest('.event-item').find('textarea').val(
		    JSON.stringify({
			event_id: $(this).closest('.event-item').find('.event_id').val(),
			name: $(this).closest('.event-item').find('.name').val(),
			start: $(this).closest('.event-item').find('.start').val(),
			end: $(this).closest('.event-item').find('.end').val(),
			description: $(this).closest('.event-item').find('.description').val()
		    })
	    );

	});
    }
    
    activate_<?= str_replace('-','_', $vars['id']); ?>();

</script>