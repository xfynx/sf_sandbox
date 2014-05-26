<td colspan="1">
    <?php echo link_to($blog_comment->getAuthor() ? $blog_comment->getAuthor() : __('-'), 'comment/edit?id='.$blog_comment->getId()) ?>
     - 
</td>