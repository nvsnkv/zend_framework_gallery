<?php

class Application_Model_Photographer
{
    public function __construct($data)
    {
        $this->name = $data['photographer'];
        
        if (isset($data['contact_email']))
            $this->email = $data['contact_email'];

        if (isset($data['contact_phone']))
            $this->phone = $data['contact_phone'];
    }

    public function __get($name)
    {
        switch($name)
        {
            case 'name': return $this->_name;
            case 'email': return $this->_email;
            case 'phone': return $this->_phone;

            default: throw new Exception("Photographer::$name doesn't exists");
        }
    }

    protected $_name;
    protected $_email;
    protected $_phone;
}

