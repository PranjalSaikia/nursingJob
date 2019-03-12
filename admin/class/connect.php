<?php

session_start();

class Config
{
    static $confArray;

    public static function read($name)
    {
        return self::$confArray[$name];
    }

    public static function write($name, $value)
    {
        self::$confArray[$name] = $value;
    }

}

// db
/*Config::write('db.host', '107.150.58.99');
Config::write('db.port', '3306');
Config::write('db.basename', 'mjgroupi_nursing');
Config::write('db.user', 'migroupi_pop');
Config::write('db.password', 'Corexx@123');*/

Config::write('db.host', 'localhost');
Config::write('db.port', '5432');
Config::write('db.basename', 'nursing');
Config::write('db.user', 'root');
Config::write('db.password', '');
class Core
{
    public $dbh; // handle of the db connexion
    private static $instance;

    private function __construct()
    {
        
        $dsn = 'mysql: host=localhost;dbname=nursing';
                   
       $user = Config::read('db.user');
        // getting DB password from config                
        $password = Config::read('db.password');


        $this->dbh = new PDO($dsn, $user, $password);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
	public static function Sanitize($str,$remove_nl=true)
    {
       

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }
        $str = addslashes(strip_tags(trim($str)));

        return $str;
    }
    public static function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
	public static function Redirect($url,$val)
    {
        header("Location: $url?go=$val");
        exit;
    }
}
?>