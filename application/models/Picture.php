<?php

class Application_Model_Picture
{
    const MAX_FILE_SIZE = 20971520;
    const CONTENT_DIR = 'content';

    public function __construct($data, $album = NULL)
    {
        $this->title = $data['title'];

        if (isset($data['location']))
            $this->location = $data['location'];

        $this->_hash = $data['hash'];
        $this->_ext = $data['ext'];

        $this->_album = (!isset($album))
                            ? Application_Model_AlbumMapper::load($data['album_id'])
                            : $album;
    }

    public static function prepareFile($data)
    {
        $hash = md5_file('./' . self::CONTENT_DIR . '/' . $data['upload']);
        $ext = pathinfo('./' . self::CONTENT_DIR . '/' . $data['upload'], PATHINFO_EXTENSION);

        if (!rename('./' . self::CONTENT_DIR . '/' . $data['upload'], './' . self::CONTENT_DIR . '/' . $hash . '.' . $ext))
            throw new Exception("Couldn't rename uploaded file!");

        $result = array();
        $result['hash'] = $hash;
        $result['ext'] = $ext;

        return $result;
    }

    public function __get($name)
    {
        switch($name)
        {
            case 'title': return $this->_title;
            case 'location' : return $this->_location;
            case 'album' : return $this->_album;
            case 'url' : return $this->getUrl();
            case 'preview' : return $this->getPreviewUrl();

            default: throw new Exception("Picture::$name doesn't exists!");
        }
    }

    public function toArray()
    {
        $result = array();
        $result['hash'] = $this->_hash;
        $result['ext'] = $this->_ext;
        $result['title'] = $this->title;
        $result['location'] = $this->location;
        $result['album_id'] = $this->album->id;

        return $result;
    }

    public function getUrl()
    {
        return '/img/no_ull.jpg';
    }

    public function getPreviewUrl()
    {
        return '/img/no_ull.jpg';
    }

    private  $_title;
    private  $_location;
    private  $_album;
    private  $_hash;
    private  $_ext;
}

