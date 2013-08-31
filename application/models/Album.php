<?php

class Application_Model_Album
{
    const DefaultThumbnail = '/img/thumb_default.jpeg';

    public function __construct($data)
    {
        if (isset($data['id']))
            $this->id = $data['id'];

        $this->title = $data['title'];
        $this->description = $data['description'];


        $this->created = (isset($data['created'])) ? new Zend_Date($data['created']) : new Zend_Date();
        $this->modified = (isset($data['modified'])) ? new Zend_Date($data['modified']) : new Zend_Date();

        $this->thumbnail = (isset($data['thumbnail'])) ? $data['thumbnail'] : self::DefaultThumbnail;

        $this->photographer = new Application_Model_Photographer($data);
    }

    public function __get($name)
    {
        switch ($name)
        {
            case 'id' : return $this->_id;
            case 'title' : return $this->_title;
            case 'description' : return $this->_description;
            case 'photographer' : return $this->_photographer;
            case 'created' : return $this->_created;
            case 'modified' : return $this->_modified;
            case 'thumbnail': return $this->_thumbnail;

            case 'pictures': return $this->getPictures();
            case 'picturesCount': return $this->getPicruresCount();

            default: throw new Exception("Album::$name doesn't exists!");
        }
    }

    protected $_id;
    protected $_title;
    protected $_description;
    protected $_photographer;
    protected $_created;
    protected $_modified;
    protected $_thumbnail;
}

