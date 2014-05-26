<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>
        <?php if (!include_slot('title')): ?>
            Главная
        <?php endif; ?>
    </title>
    <link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" <?php echo link_to('Бложик', '@homepage') ?> </a>
        </div>
        <div class="navbar-collapse collapse navbar-right navbar-form">
            <button type="button" class="btn btn-default"><?php echo link_to('Все записи', 'post/index') ?></button>
        </div>
    </div>
</div>

<!--<div id="title">-->
<div class="jumbotron">
    <div class="container">
        <h1>
            Мой личный бложик
        </h1>
    </div>
</div>

<div class="container bs-docs-container">
    <div class="row">
        <div class="col-md-3">
            <div class="bs-sidebar hidden-print affix" role="complementary"
                 style="border-radius: 5px; background-color: #dcdcdc;">
                <ul class="nav bs-sidenav">
                    <li><a href="#">Наверх</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9" role="main">
            <div class="bs-docs-section">
                <?php echo $sf_data->getRaw('sf_content') ?>
            </div>
        </div>
    </div>
</div>

<hr />
<footer class="bs-footer" role="contentinfo">
    <div class="container">
        <p>xfynx, 2013</p>
    </div>
</footer>


</body>
</html>
	