<?php

class Application_Model_AlbumMapper
{
    public static function save($album)
    {
        $db = self::getDatabase();
        $data = $album->toArray();

        if (is_numeric($data['album_id']))
        {
            throw new Exception('isset');
            return $db->update($data, array('album_id = ?' => $data['album_id']));
        }

        unset($data['album_id']);
        return $db->insert($data);
    }

    public static function load($id)
    {
        $data = self::getDatabase()->find($id)->current();

        return new Application_Model_Album($data->toArray());
    }

    public static function remove($id)
    {
        self::getDatabase()->delete($id);
    }

    private static function getDatabase()
    {
        if (!isset(self::$_db))
        {
            self::$_db = new Application_Model_DbTable_Album();
        }
        return self::$_db;
    }

    private static $_db;
}

