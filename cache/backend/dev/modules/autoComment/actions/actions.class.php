<?php

/**
 * autoComment actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage autoComment
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 16948 2009-04-03 15:52:30Z fabien $
 */
class autoCommentActions extends sfActions
{
  public function executeIndex($request)
  {
    return $this->forward('comment', 'list');
  }

  public function executeList($request)
  {
    $this->processSort();

    $this->processFilters();


    // pager
    $this->pager = new sfPropelPager('BlogComment', 20);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/blog_comment')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/blog_comment');
    }
  }

  public function executeCreate($request)
  {
    return $this->forward('comment', 'edit');
  }

  public function executeSave($request)
  {
    return $this->forward('comment', 'edit');
  }


  public function executeDeleteSelected($request)
  {
    $this->selectedItems = $this->getRequestParameter('sf_admin_batch_selection', array());

    try
    {
      foreach (BlogCommentPeer::retrieveByPks($this->selectedItems) as $object)
      {
        $object->delete();
      }
    }
    catch (PropelException $e)
    {
      $request->setError('delete', 'Could not delete the selected Blog comments. Make sure they do not have any associated items.');
      return $this->forward('comment', 'list');
    }

    return $this->redirect('comment/list');
  }

  public function executeEdit($request)
  {
    $this->blog_comment = $this->getBlogCommentOrCreate();

    if ($request->isMethod('post'))
    {
      $this->updateBlogCommentFromRequest();

      try
      {
        $this->saveBlogComment($this->blog_comment);
      }
      catch (PropelException $e)
      {
        $request->setError('edit', 'Could not save the edited Blog comments.');
        return $this->forward('comment', 'list');
      }

      $this->getUser()->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('comment/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('comment/list');
      }
      else
      {
        return $this->redirect('comment/edit?id='.$this->blog_comment->getId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete($request)
  {
    $this->blog_comment = BlogCommentPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->blog_comment);

    try
    {
      $this->deleteBlogComment($this->blog_comment);
    }
    catch (PropelException $e)
    {
      $request->setError('delete', 'Could not delete the selected Blog comment. Make sure it does not have any associated items.');
      return $this->forward('comment', 'list');
    }

    return $this->redirect('comment/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->blog_comment = $this->getBlogCommentOrCreate();
    $this->updateBlogCommentFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveBlogComment($blog_comment)
  {
    $blog_comment->save();

  }

  protected function deleteBlogComment($blog_comment)
  {
    $blog_comment->delete();
  }

  protected function updateBlogCommentFromRequest()
  {
    $blog_comment = $this->getRequestParameter('blog_comment');

    if (isset($blog_comment['email']))
    {
      $this->blog_comment->setEmail($blog_comment['email']);
    }
  }

  protected function getBlogCommentOrCreate($id = 'id')
  {
    if ($this->getRequestParameter($id) === ''
     || $this->getRequestParameter($id) === null)
    {
      $blog_comment = new BlogComment();
    }
    else
    {
      $blog_comment = BlogCommentPeer::retrieveByPk($this->getRequestParameter($id));

      $this->forward404Unless($blog_comment);
    }

    return $blog_comment;
  }

  protected function processFilters()
  {
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/blog_comment/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/blog_comment/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/blog_comment/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/blog_comment/sort'))
    {
      // camelize lower case to be able to compare with BasePeer::TYPE_PHPNAME translate field name
      $sort_column = BlogCommentPeer::translateFieldName(sfInflector::camelize(strtolower($sort_column)), BasePeer::TYPE_PHPNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/blog_comment/sort') == 'asc')
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
      'blog_comment{email}' => 'Email:',
    );
  }
}
