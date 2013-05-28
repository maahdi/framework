<?php

class DB{
    private static $instance = null;

	public static function getInstance(){
		if (self::$instance == null){
                        self::$instance = new Pdo ('mysql:dbname='.Config::SQL_BASE.';host='.Config::SQL_HOST,Config::SQL_USER,Config::SQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    }
                return self::$instance;
	}
}
