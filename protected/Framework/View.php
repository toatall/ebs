<?php

class View
{
	
	function render($viewName, $data = null)
	{
						
		$content = $this->requireToVar('protected/Views/' . $viewName . '.php', $data);		
		include 'protected/Views/layout/main.php';
		
	}
	
	
	function renderPartial($viewName, $data = null)
	{
		if(is_array($data))
			extract($data);
		include 'protected/Views/' . $viewName . '.php';		
	}
	
	
	private function requireToVar($fileName, $data)
	{
		if(is_array($data))
		{
			// преобразуем элементы массива в переменные
			//extract($data);
			if(is_array($data))
				extract($data);
		
		}
		
		ob_start();
		ob_implicit_flush(false);
		require($fileName);
		return ob_get_clean();
	}
	
	
}