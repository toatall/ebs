<?php		
		
	require 'protected/config/main.php';
	require 'protected/Framework/MSSQL.php';
	require 'protected/Framework/Browser.php';
	
	$sql = new MSSQL();
	
	// проверка ИД
	if (count($_GET))
	{
		$key = key($_GET);
		$query = $sql->execSQLParams('select top 1 * from EBS_FILES where [guid]=:guid order by date_add desc', [':guid'=>$key]);
		if ($query):
		
			$browser = Browser::get();	
			
			$sql->execSQL("insert into [EBS_FILES_LOG] ([file_id],[user_ip],[user_browser_agent]"
						.",[user_browser_name],[user_browser_version] ,[user_browser_platform]) \n"
						."values ('".$query[0]['id']."','".$_SERVER['REMOTE_ADDR']."','".$browser['userAgent']."','"
						.$browser['name']."', '".$browser['version']."', '".$browser['platform']."')");
			
			$filename = $query[0]['filename'];
			
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($filename));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filename));
			ob_clean();
			flush();
			readfile($filename);
			exit;
						
		else:
			
		?>
		<h2>Файл не найден, проверьте правильность ввода ссылки!</h2>
		<?php
		
		endif;
		
	}
	else
	{
		?>
		<h2>Ссылка введена некорректно! Проверте правильность ввода ссылки!</h2>
		<?php
	}
	