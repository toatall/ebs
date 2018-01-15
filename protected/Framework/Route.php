<?php

class Route 
{
	
	
	const DEFAULT_CONROLLER = 'admin';
	const DEFAULT_ACTION = 'index';
	
	
	private static $currentController;
	private static $currentAction;
	
	
	
	public static function run()
	{
		session_start();
		
		
		$controllerName = self::DEFAULT_CONROLLER;
		$actionName = self::DEFAULT_ACTION;
		
		$route = null;
		
		
		
		if (isset($_GET['r']))
		{				
			$route = explode('/', $_GET['r']);
		}
			
		// имя контроллера
		if (!empty($route[0]))
		{
			$controllerName = $route[0];
		}
		
		// имя действия
		if (!empty($route[1]))
		{
			$actionName = $route[1];
		}
		
		/*
		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		*/
		
		
		// подцепляем файл с классом модели (файла модели может и не быть)

		$modelFile = strtolower($controllerName).'.php';
		$modelPath = "protected/Models/".$modelFile;
		if(file_exists($modelPath))
		{
			include $modelPath;
		}

		// подцепляем файл с классом контроллера
		$controllerFile = strtolower($controllerName).'Controller.php';
		$controllerPath = "protected/Controllers/".$controllerFile;
		if(file_exists($controllerPath))
		{			
			include $controllerPath;			
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::httpError404();
		}
		
		// создаем контроллер
		
		$classController = $controllerName . 'Controller';
		$controller = new $classController;
		$action = 'action' . $actionName;
		
		self::$currentController = $controllerName;
		self::$currentAction = $actionName;
		
		$controller->checkAccess($actionName);
				
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::httpError404();
		}
		
		
		
	
	}	
	
	public static function httpError404()
	{
		
		//$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		//header('HTTP/1.1 404 Not Found');
		//header("Status: 404 Not Found");
		//exit;
		$view = new View();
		$view->render('default/error', ['errorMessage'=>'Ошибка 404!']);
		exit;
		//header('Location:'.$host.'404');
	}
	
	public static function httpErrorCode($code, $message)
	{
		$view = new View();
		$view->render('default/error', ['errorCode' => $code, 'errorMessage'=>$message]);
		exit;
	}
	
	
	public static function redirect($route)
	{
		header('location: ' . $_SERVER['SCRIPT_NAME'] . '?r=' . $route);
		exit;
	}
	
	
	public static function createUrl($url=null, $params=[])
	{
		
		$p = '';
		foreach ($params as $key=>$value)
		{
			$p .= '&' . $key . '=' . $value;
		}
		
		return $_SERVER['SCRIPT_NAME'] . '?r=' . (($url == null) 
			? self::$currentController . '/' . self::$currentAction : $url) . $p;
	}
	
	
}