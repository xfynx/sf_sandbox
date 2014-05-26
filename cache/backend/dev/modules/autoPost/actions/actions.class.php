<?php

/**
 * autoPost actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage autoPost
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 16948 2009-04-03 15:52:30Z fabien $
 */
class autoPostActions extends sfActions
{
  public function executeIndex($request)
  {
    return $this->forward('post', 'list');
  }

  public function executeList($request)
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/blog_post/filters');

    // pager
    $this->pager = new sfPropelPager('BlogPost', 5);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/blog_post')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/blog_post');
    }
  }

  public function executeCreate($request)
  {
    return $this->forward('post', 'edit');
  }

  public function executeSave($request)
  {
    return $this->forward('post', 'edit');
  }


  public function executeDeleteSelected($request)
  {
    $this->selectedItems = $this->getRequestParameter('sf_admin_batch_selection', array());

    try
    {
      foreach (BlogPostPeer::retrieveByPks($this->selectedItems) as $object)
      {
        $object->delete();
      }
    }
    catch (PropelException $e)
    {
      $request->setError('delete', 'Could not delete the selected Blog posts. Make sure they do not have any associated items.');
      return $this->forward('post', 'list');
    }

    return $this->redirect('post/list');
  }

  public function executeEdit($request)
  {
    $this->blog_post = $this->getBlogPostOrCreate();

    if ($request->isMethod('post'))
    {
      $this->updateBlogPostFromRequest();

      try
      {
        $this->saveBlogPost($this->blog_post);
      }
      catch (PropelException $e)
      {
        $request->setError('edit', 'Could not save the edited Blog posts.');
        return $this->forward('post', 'list');
      }

      $this->getUser()->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('post/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('post/list');
      }
      else
      {
        return $this->redirect('post/edit?id='.$this->blog_post->getId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete($request)
  {
    $this->blog_post = BlogPostPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->blog_post);

    try
    {
      $this->deleteBlogPost($this->blog_post);
    }
    catch (PropelException $e)
    {
      $request->setError('delete', 'Could not delete the selected Blog post. Make sure it does not have any associated items.');
      return $this->forward('post', 'list');
    }

    return $this->redirect('post/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->blog_post = $this->getBlogPostOrCreate();
    $this->updateBlogPostFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveBlogPost($blog_post)
  {
    $blog_post->save();

  }

  protected function deleteBlogPost($blog_post)
  {
    $blog_post->delete();
  }

  protected function updateBlogPostFromRequest()
  {
    $blog_post = $this->getRequestParameter('blog_post');

    if (isset($blog_post['title']))
    {
      $this->blog_post->setTitle($blog_post['title']);
    }
    if (isset($blog_post['excerpt']))
    {
      $this->blog_post->setExcerpt($blog_post['excerpt']);
    }
    if (isset($blog_post['body']))
    {
      $this->blog_post->setBody($blog_post['body']);
    }
    if (isset($blog_post['created_at']))
    {
      if ($blog_post['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($blog_post['created_at']))
          {
            $value = $dateFormat->format($blog_post['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $blog_post['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->blog_post->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->blog_post->setCreatedAt(null);
      }
    }
  }

  protected function getBlogPostOrCreate($id = 'id')
  {
    if ($this->getRequestParameter($id) === ''
     || $this->getRequestParameter($id) === null)
    {
      $blog_post = new BlogPost();
    }
    else
    {
      $blog_post = BlogPostPeer::retrieveByPk($this->getRequestParameter($id));

      $this->forward404Unless($blog_post);
    }

    return $blog_post;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/blog_post/filters');

      $filters = $this->getRequestParameter('filters');
      if(is_array($filters))
      {
        if (isset($filters['created_at']['from']) && $filters['created_at']['from'] !== '')
        {
          $filters['created_at']['from'] = $this->getContext()->getI18N()->getTimestampForCulture($filters['created_at']['from'], $this->getUser()->getCulture());
        }
        if (isset($filters['created_at']['to']) && $filters['created_at']['to'] !== '')
        {
          $filters['created_at']['to'] = $this->getContext()->getI18N()->getTimestampForCulture($filters['created_at']['to'], $this->getUser()->getCulture());
        }
        $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/blog_post');
        $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/blog_post/filters');
        $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/blog_post/filters');
      }
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/blog_post/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/blog_post/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/blog_post/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['title_is_empty']))
    {
      $criterion = $c->getNewCriterion(BlogPostPeer::TITLE, '');
      $criterion->addOr($c->getNewCriterion(BlogPostPeer::TITLE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['title']) && $this->filters['title'] !== '')
    {
      $c->add(BlogPostPeer::TITLE, strtr($this->filters['title'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['created_at_is_empty']))
    {
      $criterion = $c->getNewCriterion(BlogPostPeer::CREATED_AT, '');
      $criterion->addOr($c->getNewCriterion(BlogPostPeer::CREATED_AT, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['created_at']))
    {
      if (isset($this->filters['created_at']['from']) && $this->filters['created_at']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(BlogPostPeer::CREATED_AT, $this->filters['created_at']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['created_at']['to']) && $this->filters['created_at']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(BlogPostPeer::CREATED_AT, $this->filters['created_at']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(BlogPostPeer::CREATED_AT, $this->filters['created_at']['to'], Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/blog_post/sort'))
    {
      // camelize lower case to be able to compare with BasePeer::TYPE_PHPNAME translate field name
      $sort_column = BlogPostPeer::translateFieldName(sfInflector::camelize(strtolower($sort_column)), BasePeer::TYPE_PHPNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/blog_post/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'blog_post{id}' => 'Id:',
      'blog_post{title}' => 'Title:',
      'blog_post{excerpt}' => 'Excerpt:',
      'blog_post{body}' => 'Body:',
      'blog_post{created_at}' => 'Creation date:',
    );
  }
}
