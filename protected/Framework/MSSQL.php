<?php

class MSSQL 
{
	
	private $connect = null;
	
	public $convertCharset = true;
	public $countRows = 0;
	
	
	
	public function __construct($sqlServer=null, $sqlDb=null, $sqlUser=null, $sqlPassword=null)
	{
		if ($this->connect === null)
		{
			$this->connect($sqlServer, $sqlDb, $sqlUser, $sqlPassword);			
		}
		
	}
		
	
	private function connect($sqlServer, $sqlDb, $sqlUser, $sqlPassword)
	{
		$sqlServer = ($sqlServer == null) ? Config::params()['sqlServer'] : $sqlServer;
		$sqlDb = ($sqlDb == null) ? Config::params()['sqlDb'] : $sqlDb;
		$sqlUser = ($sqlUser == null) ? Config::params()['sqlUser'] : $sqlUser;
		$sqlPassword = ($sqlPassword == null) ? Config::params()['sqlPassword'] : $sqlPassword;
			
		$this->connect = new PDO("sqlsrv:server={$sqlServer};database={$sqlDb}", $sqlUser, $sqlPassword);
	}
	
	
	public function execSQL($query_string)
	{		
		return $this->connect->exec($query_string);		
	}
	
	
	public function querySQL($query_str) 
	{	
		$query = $this->connect->query($query_str);
		return $query->fetchAll();			
	}
	
	public function getErrors()
	{
		return print_r($this->connect->errorInfo(),true);
	}
	
	public function execSQLParams($quer_string, $params)
	{
		$query = $this->connect->prepare($quer_string);		
		$query->execute($params);
		return $query->fetchAll();
	}
	
	
}