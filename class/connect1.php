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
Config::write('db.host', 'ec2-54-243-54-6.compute-1.amazonaws.com');
Config::write('db.port', '5432');
Config::write('db.basename', 'd19fms3qiud691');
Config::write('db.user', 'xfcakixhdtjkhi');
Config::write('db.password', '938d68a81b31203af9854499d5c89033a171a0dd4bc756ead8377147fd71ddd9');
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