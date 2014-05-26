<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<div id="navigation">
    <ul style="list-style:none;">
        <li><?php echo link_to('Посты', 'post/index') ?></li>
        <li><?php echo link_to('Комментарии', 'comment/index') ?></li>
    </ul>
</div>
<div id="content">
    <?php echo $sf_data->getRaw('sf_content') ?>
</div>
</body>
</html>
