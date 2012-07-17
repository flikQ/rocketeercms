<h1>New User Right</h1>
<?php echo partial('validation'); ?>
<?php echo form_open('admin/user_rights/create'); ?>
<h3>Key:</h3>
<?php echo form_input('key'); ?><br>
<h3>Default Value:</h3>
<?php echo form_checkbox('value', '1'); ?><br><br>
<?php echo form_submit('submit', 'Create'); ?>
</form>
