<?php use_helper('Object') ?>

<div class="sf_admin_filters">
<?php echo form_tag('post/list', array('method' => 'get')) ?>

  <fieldset>
    <h2><?php echo __('filters') ?></h2>
    <div class="form-row">
    <label for="filters_title"><?php echo __('Title:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[title]', isset($filters['title']) ? $filters['title'] : null, array (
  'size' => 15,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_created_at"><?php echo __('Creation date:') ?></label>
    <div class="content">
    <?php echo input_date_range_tag('filters[created_at]', isset($filters['created_at']) ? $filters['created_at'] : null, array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf/sf_admin/images/date.png',
)) ?>
    </div>
    </div>

      </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('reset'), 'post/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('filter'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
