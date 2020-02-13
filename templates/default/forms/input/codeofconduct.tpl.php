<input type="checkbox" data-toggle="toggle" data-onstyle="info"
	data-on="<?php echo \Idno\Core\Idno::site()->language()->_('Yes'); ?>"
	data-off="<?php echo \Idno\Core\Idno::site()->language()->_('No'); ?>"
	value="y" id="<?= $vars['id']; ?>"
	name="<?= $vars['name']; ?>" <?php if ($vars['value']=='y' || empty($vars['value'])) echo 'checked'; ?>>