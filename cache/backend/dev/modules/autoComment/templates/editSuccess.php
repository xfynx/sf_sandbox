<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('edit comment', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('comment/edit_header', array('blog_comment' => $blog_comment)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('comment/edit_messages', array('blog_comment' => $blog_comment, 'labels' => $labels)) ?>
<?php include_partial('comment/edit_form', array('blog_comment' => $blog_comment, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('comment/edit_footer', array('blog_comment' => $blog_comment)) ?>
</div>

</div>
