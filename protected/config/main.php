<?php

class Config
{
	
	public static function params()
	{
		return [
			// Настройки MS SQL
			'sqlServer' => 'server_sql',
			'sqlDb' => 'database_sql',
			'sqlUser' => 'user_sql',
			'sqlPassword' => 'password_sql',
				
			'countRowsTable' => 30,
				
			'upploadDir' => 'c:\nalog\EBS\share_files\\'.date('Y-m-d').'\\',
			'fileLink' => 'share_files/' .date('Y-m-d').'/',
		];
	}
	
}