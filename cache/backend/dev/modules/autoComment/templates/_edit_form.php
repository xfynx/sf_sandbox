<?php echo form_tag('comment/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($blog_comment, 'getId') ?>

<fieldset id="sf_fieldset_test" class="">
<h2><?php echo __('Test') ?></h2>


<div class="form-row">
  <?php echo label_for('blog_comment[email]', __($labels['blog_comment{email}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('blog_comment{email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('blog_comment{email}')): ?>
    <?php echo form_error('blog_comment{email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($blog_comment, 'getEmail', array (
  'size' => 80,
  'control_name' => 'blog_comment[email]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('blog_comment' => $blog_comment)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($blog_comment->getId()): ?>
<?php echo button_to(__('delete'), 'comment/delete?id='.$blog_comment->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
