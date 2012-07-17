<h2>Comments:</h2>
<?php foreach($model->comments as $comment) : ?>
<br><b><?php echo link_to($comment->user->full_name(), 'profile/'.$comment->user->username); ?></b>
<p><?php echo $comment->content; ?></p>
<?php endforeach; ?>

<?php echo partial('validation'); ?>

<?php echo form_open('comments/create'); ?>
<?php echo form_hidden('resource', plural(get_class($model))); ?>
<?php echo form_hidden('resource_id', $model->id); ?>
<?php echo form_textarea('comment'); ?><br>
<?php echo form_submit('submit', 'Add Comment!'); ?>
</form>
