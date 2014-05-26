<td colspan="4">
    <?php echo link_to($blog_post->getTitle() ? $blog_post->getTitle() : __('-'), 'post/edit?id='.$blog_post->getId()) ?>
     - 
    <?php echo $blog_post->getExcerpt() ?>
     - 
    <?php echo $blog_post->getNbComments() ?>
     - 
    <?php echo ($blog_post->getCreatedAt() !== null && $blog_post->getCreatedAt() !== '') ? format_date($blog_post->getCreatedAt(), "f") : '' ?>
     - 
</td>