<?php
	

	include 'protected/config/main.php';

	include 'protected/Framework/Model.php';
	include 'protected/Framework/View.php';
	include 'protected/Framework/Controller.php';
	include 'protected/Framework/Route.php';
	
	include 'protected/Framework/CHtml.php';
	include 'protected/Framework/MSSQL.php';
	
	Route::run();

	
