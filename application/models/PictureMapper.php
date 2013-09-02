<?php

class Application_Model_PictureMapper
{


    public static function save($picture)
    {
       $db = self::getDatabase();
       $data = $picture->toArray();

       $row = $db->find($data['hash']);
       if (count($row) > 0)
       {
           unset($data['hash']);
           return $db->update($data,array('hash = ?' => $data['hash']));
       }



       return $db->insert($data);
    }

    private static function getDatabase()
    {
        if (!isset(self::$_db))
        {
            self::$_db = new Application_Model_DbTable_Picture();
        }
        return self::$_db;
    }

    private static $_db;

    public static function load($hash)
    {
        $data = self::getDatabase()->find($hash)->current();

        return new Application_Model_Picture($data->toArray());
    }

    public static function remove($hash)
    {
        $db = self::getDatabase();

        $db->delete(array(' `hash` = ? ' => $hash));
    }

    public static function getPicturesCount($album)
    {
        $set = self::getDatabase()->fetchAll(array("`album_id` = ?" => $album->id));

        return count($set);
    }

    public static function getPictures($album)
    {
        $set = self::getDatabase()->fetchAll(array("`album_id` = ?" => $album->id));
        $result = array();

        foreach ($set as $row)
            $result[] = new Application_Model_Picture($row->toArray());

        return $result;
    }
}

