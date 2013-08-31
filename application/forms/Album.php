<?php

class Application_Form_Album extends Zend_Form
{
    protected $id;

    public function getId() { return $this->id; }
    public function setId($value) { $this->id = $value; }

    public function init($submitText = 'Create')
    {
        $title = $this->createElement('text', 'title');
        $title->setLabel('Title:')
              ->setRequired(true)
              ->addValidator('NotEmpty')
              ->addValidator('StringLength', false, array(1,50));

        $this->addElement($title);

        $description = $this->createElement('textarea', 'description');
        $description->setLabel('Description:')
                    ->setRequired(true)
                    ->addValidator('NotEmpty')
                    ->addValidator('StringLength', false, array(1,200));

        $this->addElement($description);

        $photographer = $this->createElement('text', 'photographer');
        $photographer->setLabel('Photographer:')
                     ->setRequired(true)
                     ->addValidator('NotEmpty')
                     ->addValidator('StringLength', false, array(1,50));

        $this->addElement($photographer);

        $email = $this->createElement('text', 'contact_email');
        $email->setLabel('Contact email:')
              ->setRequired(false)
              ->addValidator('EmailAddress');

        $this->addElement($email);

        $phone = $this->createElement('text', 'contact_phone');
        $phone->setLabel('Contact phone:')
            ->setRequired(false)
            ->addValidator('Regex', false, array('pattern' => '/\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/',
                                                 'messages'=>array( 'regexNotMatch'=>'Invalid number given')
                                                )
            );

        $this->addElement($phone);

        $submit = $this->createElement('submit','submit');
        $submit->setLabel($submitText);

        $this->addElement($submit);
    }


}

