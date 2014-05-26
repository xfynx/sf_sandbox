<?php slot('title', $blog_post->getTitle()) ?>

<h2 style="font-size: 40px;"><b><?php echo $blog_post->getTitle() ?></b></h2>
<div hidden="true"><?php echo $blog_post->getId() ?></div>
<h3><?php echo $blog_post->getExcerpt() ?></h3>
<p style="width:800px"><?php echo $blog_post->getBody() ?></p>
<p><b>Опубликовано: <?php echo $blog_post->getCreatedAt() ?></b></p>
<hr />
<?php echo link_to('Комментировать', 'comment/new?blog_post_id='.$blog_post->getId()) ?>
<hr />
<?php use_helper('Text', 'Date') ?>
<?php if ($comments) : ?>
    <a id="comments"></a>
    <?php $commentCount = count($comments); $rightCase = "комментариев."?>
    <?php if($commentCount==1)
        $rightCase = "комментарий.";
    if(($commentCount<=4)&&($commentCount>=2))
        $rightCase = "комментария.";
    ?>

    <p> <?php echo $commentCount." ".$rightCase ?></p>
    <?php foreach ($comments as $comment): ?>
        <p style="text-decoration: underline;"><em>Написал(а) <b><?php echo $comment->getAuthor() ?></b></em></p>
        <div class="comment" style="margin-bottom:10px;border: 1px inherit #0000ff">
            <?php echo simple_format_text($comment->getBody()) ?>
        </div>
        <?php echo format_date($comment->getCreatedAt()) ?>
        <hr />
    <?php endforeach; ?>
<?php endif; ?>
<hr />