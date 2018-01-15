<?php

class DocumentController extends Controller
{
	
	public function actionRule()
	{
		return ['deny'=>[
			'actions' => ['create', 'update', 'delete', 'statistic'], 
			'checkAcceess' => isset($_SESSION['isLogin']) && $_SESSION['isLogin'],
			'redirect'=>'admin/login',
		]];
	}
	
	
	public function actionCreate()
	{
		
		$model = new Document();
		$model->isNewRecord = true;
		
		if (isset($_POST['Document']))
		{			
			$model->typeNp = $_POST['Document']['typeNp'];
			$model->innNp = $_POST['Document']['innNp'];
			$model->description = $_POST['Document']['description'];
			if ($model->save())
				Route::redirect('admin/index');
		}
		
		$this->view->render('document/create', ['model'=>$model]);
		
	}
	
	public function actionUpdate()
	{
		if (!isset($_GET['id']) || !is_numeric($_GET['id']))
			Route::httpError404();
		
		$model = new Document();
		$model->isNewRecord = false;
		if (!$model->loadFromBase($_GET['id']))
			Route::httpError404();
				
		if (isset($_POST['Document']))
		{
			$model->typeNp = $_POST['Document']['typeNp'];
			$model->innNp = $_POST['Document']['innNp'];
			$model->description = $_POST['Document']['description'];
			if ($model->save())
				Route::redirect('admin/index');
		}
		
		$this->view->render('document/update', ['model'=>$model]);
		
	}
	
	
	public function actionDelete()
	{
		if (!isset($_GET['id']) || !is_numeric($_GET['id']))
			Route::httpError404();
		
		$model = new Document();
			
		if (!$model->loadFromBase($_GET['id']))
			Route::httpError404();
		
		$model->delete($_GET['id']);
		
		Route::redirect('admin/index');
	}
	
	
	
	public function actionStatistic()
	{
		if (!isset($_GET['id']) || !is_numeric($_GET['id']))
			Route::httpError404();
		$model = new Document();
			
		if (!$model->loadFromBase($_GET['id']))
			Route::httpError404();
		
		$this->view->renderPartial('document/statistic', ['model'=>$model]);
		
			
	}
	
	
	
	
	
	
	
}