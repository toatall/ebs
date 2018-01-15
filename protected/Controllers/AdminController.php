<?php

class AdminController extends Controller
{
	
	
	public function actionRule()
	{
		return ['deny'=>[
			'actions' => ['index'],
			'checkAcceess' => isset($_SESSION['isLogin']) && $_SESSION['isLogin'],
			'redirect'=>'admin/login',
		]];
	}
	
	
	
	public function actionIndex()
	{
		$this->view->render('admin/index');
	}
	
	
	public function actionLogin()
	{
					
		require 'protected/Models/Login.php';
		
		$model = new Login();
		
		
		if (isset($_POST['Login']))
		{
			$model->username = $_POST['Login']['username'];
			$model->password = $_POST['Login']['password'];
			$model->validate();
		}
		
		
		if ($model->isLogin())
		{
			Route::redirect('admin/index');	
		}
		
		$this->view->render('admin/login', ['model'=>$model]);
		
	}
	
	
	public function actionLogout()
	{
		require 'protected/Models/Login.php';
		$model = new Login();
		$model->logout();
		Route::redirect('admin/login');	
	}
	
	
	
	
	

}

