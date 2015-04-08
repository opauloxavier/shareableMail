<?php

	if($_SERVER['SERVER_NAME']=='localhost'){
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