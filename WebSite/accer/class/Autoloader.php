<?php
class Autoloader
{
	public static function register()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	public static function autoload($class)
	{
		if (file_exists(WEB_PATH.'/class/' . $class . '.php')){
			require WEB_PATH.'/class/' . $class . '.php';
		} else {
			throw new Exception('La classe <strong>' . $class . '</strong> n\'a pu être trouvée !');
		}     
	}
}