<?php

class Controller
{
	
	public $model;
	public $view;
	
		
	public function actionRule()
	{
		return [];
	}
	
	
	function __construct()
	{		
		$this->view = new View();
	}	
	
	
	
	public function checkAccess($actionName)
	{
		$flagRule = true;
		$actionRule = $this->actionRule();
		
		if (isset($actionRule['deny']))
		{
			if (isset($actionRule['deny']['actions']) && in_array($actionName, $actionRule['deny']['actions']))
			{								
				if (!isset($actionRule['deny']['checkAcceess']) || !$actionRule['deny']['checkAcceess'])
				{
					$flagRule = false;
				}
				
			}
		}
		
		
		
		if (!$flagRule)
		{
			if (isset($actionRule['deny']['redirect']))
			{
				header('location: ' . $_SERVER['SCRIPT_NAME'] . '?r=' . $actionRule['deny']['redirect']);
			}
			else
			{
				Route::httpErrorCode('403', 'Доступ запрещен');
			}
			
		}
		
		
	}
	
	
}