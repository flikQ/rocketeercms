<div id="mainbody"> 
<h1>Additional Columns</h1>
<?php echo form_open('admin/users/create_column'); ?>
	<div class="form-row"><label>Column Name</label>
	<input type="text" name="column"></div>
	<div class="form-row"><label>Column Type</label>
	<select size="1" name="type">
	<option value="int">Number(Integer)</option>
	<option value="varchar" selected>Small Text(Varchar)</option>
	<option value="text">Big Text(TEXT)</option>
	</select></div>
	
	<input type="submit" value="Create">
	</form>

	<ul class="action-buttons">
		<li><a href="#" id="add-column" class="generic_button large float-left">Add Field</a></li>
	</ul>


<ul class="big-list">
<?php foreach($columns as $column) : ?>
	<li>
		<h3><?php echo $column['column']; ?></h3>
		<ul class="buttons"><li><?php echo link_to('Remove', 'admin/users/remove_column/column/'.$column['column'], '.delete'); ?></li></ul>
	</li>
<?php endforeach; ?>
</ul>


</div>