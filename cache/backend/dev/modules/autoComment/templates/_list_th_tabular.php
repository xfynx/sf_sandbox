  <th id="sf_admin_list_th_author">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/blog_comment/sort') == 'author'): ?>
      <?php echo link_to(__('Author'), 'comment/list?sort=author&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_comment/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_comment/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Author'), 'comment/list?sort=author&type=asc') ?>
      <?php endif; ?>
          </th>
