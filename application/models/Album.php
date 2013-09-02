<?php

class Application_Model_Album
{
    const DefaultThumbnail = '/img/thumb_default.jpg';

    public function __construct($data)
    {
        if (isset($data['album_id']))
            $this->id = $data['album_id'];

        $this->title = $data['title'];

        $this->description = $data['description'];

        $this->created = (isset($data['created'])) ? new Zend_Date($data['created']) : new Zend_Date();
        $this->modified = (isset($data['modified'])) ? new Zend_Date($data['modified']) : new Zend_Date();

        $this->thumbnail = (isset($data['thumbnail'])) ? $data['thumbnail'] : self::DefaultThumbnail;

        $this->photographer = new Application_Model_Photographer($data);
    }

    public function toArray()
    {
        $result = array();
        $result['album_id'] = $this->id;
        $result['title'] = $this->title;
        $result['description'] = $this->description;
        $result['created'] = $this->created->get('YYYY-MM-dd HH:mm:ss');
        $result['modified'] = $this->modified->get('YYYY-MM-dd HH:mm:ss');
        $result['thumbnail'] = $this->thumbnail;

        $result['photographer'] = $this->photographer->name;
        $result['contact_email'] = $this->photographer->email;
        $result['contact_phone'] = $this->photographer->phone;

        return $result;
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

    private $_id;
    private $_title;
    private $_description;
    private $_photographer;
    private $_created;
    private $_modified;
    private $_thumbnail;

    private function getPicruresCount()
    {
        return Application_Model_PictureMapper::getPicturesCount($this);
    }

    private function getPictures()
    {
        return Application_Model_PictureMapper::getPictures($this);
    }
}

