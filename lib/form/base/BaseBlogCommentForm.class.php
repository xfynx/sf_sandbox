<?php

/**
 * BlogComment form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 */
class BaseBlogCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'blog_post_id' => new sfWidgetFormPropelChoice(array('model' => 'BlogPost', 'add_empty' => true)),
      'author'       => new sfWidgetFormInput(),
      'email'        => new sfWidgetFormInput(),
      'body'         => new sfWidgetFormTextarea(),
      //'created_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'BlogComment', 'column' => 'id', 'required' => false)),
      'blog_post_id' => new sfValidatorPropelChoice(array('model' => 'BlogPost', 'column' => 'id', 'required' => false)),
      'author'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'         => new sfValidatorString(array('required' => false)),
      //'created_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogComment';
  }


}
