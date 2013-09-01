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
}

