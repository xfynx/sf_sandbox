  <th id="sf_admin_list_th_title">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/blog_post/sort') == 'title'): ?>
      <?php echo link_to(__('Title'), 'post/list?sort=title&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_post/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_post/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Title'), 'post/list?sort=title&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_excerpt">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/blog_post/sort') == 'excerpt'): ?>
      <?php echo link_to(__('Excerpt'), 'post/list?sort=excerpt&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_post/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_post/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Excerpt'), 'post/list?sort=excerpt&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_nb_comments">
        <?php echo __('Comments') ?>
          </th>
  <th id="sf_admin_list_th_created_at">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/blog_post/sort') == 'created_at'): ?>
      <?php echo link_to(__('Creation date'), 'post/list?sort=created_at&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_post/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/blog_post/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Creation date'), 'post/list?sort=created_at&type=asc') ?>
      <?php endif; ?>
          </th>
