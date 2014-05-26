<?php

/**
 * BlogComment form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
class BlogCommentForm extends BaseBlogCommentForm
{
    public function configure()
    {parent::setup();
        $this->widgetSchema['blog_post_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['email'] = new sfValidatorEmail(
            array('required' => false),
            array('invalid' => 'Введите корректный email'));
			
		$this->widgetSchema['author']= new sfWidgetFormInput(array('label'=>'автор'));

     
    }
}
