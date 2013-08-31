<?php

class Application_Model_AlbumMapper
{
    public static function save($album)
    {
        $db = self::getDatabase();
        $data = self::getAlbumArray($album);

        if (isset($data['id']))
            return $db->update($data, array('id = ?' => $data['id']));

        return $db->insert($data);
    }

    private static function getDatabase()
    {
        if (!isset(self::$_db))
        {
            self::$_db = new Application_Model_DbTable_Album();
        }
        return self::$_db;
    }

    private static function getAlbumArray($album)
    {
        $result = array();
        $result['id'] = $album->id;
        $result['title'] = $album->title;
        $result['description'] = $album->description;
        $result['created'] = $album->created->get('YYYY-MM-dd HH:mm:ss');
        $result['modified'] = $album->modified->get('YYYY-MM-dd HH:mm:ss');
        $result['thumbnail'] = $album->thumbnail;

        $result['photographer'] = $album->photographer->name;
        $result['contact_email'] = $album->photographer->email;
        $result['contact_phone'] = $album->photographer->phone;

        return $result;
    }

    private static $_db;
}

