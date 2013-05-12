<?php
class Config{
	const SALT = "<b}DKJ{]1QlcW<-`Kn|ENm(w1|9>epVQvkhyEaN*dfJEA{MZ";
	const SQL_HOST = "localhost";
	const SQL_PASS ="martini";
	const SQL_USER = "yoshi";
        const SQL_BASE = "appligestionMVC";

	static function hashPassword($p){
		return sha1(self::SALT.md5($p.self::SALT).sha1(self::SALT));
	}

}