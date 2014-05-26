<?php echo form_tag('post/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($blog_post, 'getId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('blog_post[title]', __($labels['blog_post{title}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('blog_post{title}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('blog_post{title}')): ?>
    <?php echo form_error('blog_post{title}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($blog_post, 'getTitle', array (
  'control_name' => 'blog_post[title]',
  'size' => 53,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('blog_post[excerpt]', __($labels['blog_post{excerpt}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('blog_post{excerpt}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('blog_post{excerpt}')): ?>
    <?php echo form_error('blog_post{excerpt}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($blog_post, 'getExcerpt', array (
  'control_name' => 'blog_post[excerpt]',
  'size' => '50x2',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('blog_post[body]', __($labels['blog_post{body}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('blog_post{body}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('blog_post{body}')): ?>
    <?php echo form_error('blog_post{body}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($blog_post, 'getBody', array (
  'control_name' => 'blog_post[body]',
  'size' => '50x10',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('blog_post[created_at]', __($labels['blog_post{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('blog_post{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('blog_post{created_at}')): ?>
    <?php echo form_error('blog_post{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($blog_post, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf/sf_admin/images/date.png',
  'control_name' => 'blog_post[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('blog_post' => $blog_post)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($blog_post->getId()): ?>
<?php echo button_to(__('delete'), 'post/delete?id='.$blog_post->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
