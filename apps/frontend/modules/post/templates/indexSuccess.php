<h1>Список статей</h1>
<?php slot('title', 'Список статей') ?>
<br />
    <?php foreach ($blog_post_list as $blog_post): ?>
        <?php
            $commentCount = new Criteria();
            $commentCount->add(BlogCommentPeer::BLOG_POST_ID, $blog_post->getId());
            $commentCount = count(BlogCommentPeer::doSelect($commentCount));
            $url = url_for('post/show?id='.$blog_post->getId());
        ?>
        <h2><?php echo $blog_post->getTitle()/*link_to($blog_post->getTitle(), '@post?title='.$blog_post->getStrippedTitle())*/ ?></h2>
        <p><?php echo $blog_post->getExcerpt() ?></p>
        <?php use_helper('Text', 'Date') ?>
        <p>Опубликовано: <?php echo format_date($blog_post->getCreatedAt()) /*$blog_post->getCreatedAt()*/ ?></p>
        <p><a href="<?php echo $url.'#comments'?>">Комментариев: <?php echo $commentCount ?></a></p>
        <a class="btn btn-primary btn-lg" role="button" href="<?php echo $url?>">Перейти к статье »</a>
        <hr/>
    <?php endforeach; ?>
