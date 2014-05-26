<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Post detail', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('post/edit_header', array('blog_post' => $blog_post)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('post/edit_messages', array('blog_post' => $blog_post, 'labels' => $labels)) ?>
<?php include_partial('post/edit_form', array('blog_post' => $blog_post, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('post/edit_footer', array('blog_post' => $blog_post)) ?>
</div>

</div>
