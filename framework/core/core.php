<?php
	date_default_timezone_set('Brazil/East');

	define('ST_PATH','framework/assets/');
	define('CONF_PATH','config/');
	define('PAGES_URL','pages/');

	define('SITE_TITLE','Essencia do Prazer');
	define('SITE_URL','http://essenciadoprazer.com.br');
	define("THEME_URL","framework/template/default/");


	if($_SERVER['SERVER_NAME']=='dev.pauloxavier.com'){
		define("url","http://localhost/coming");
		define("db_table", "users");
		define("db_user","localhost");
		define("db_name","newsletter");
		define("db_login","root");
		define("db_password","");
	}


	else{
		define("url","http://www.mimelo.com.br");
		define("db_table", "users");
		define("db_user","localhost");
		define("db_name","newsletter");
		define("db_login","root");
		define("db_password","");
	}
?>