<?php
                                // mysql.zzz.com.ua               
class Database                   //Jesusestvivant7
{
    private static $dbHost = "mysql.zzz.com.ua";
    private static $dbName = "deferdy";
    private static $dbUsername ="deferdy";
    private static $dbUserpassword ="Jesus@2016";
    
    private static $connection = null;
    
    public static function connect()
    {
        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName.";charset=utf8" , self::$dbUsername, self::$dbUserpassword);


            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }

}

?>