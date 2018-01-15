<?php
	
	$sql = new MSSQL();

	$query = "select * from [EBS_FILES_LOG] where [file_id] = " . $model->id
			. " order by date_add desc";
		
	$resultArray = $sql->querySQL($query);

?>

<table class="table table-hover table-bordered">
	<tr>
		<th>ИД</th>		
		<th>Дата</th>
		<th>ip адрес</th>
		<th>Браузер</th>
		<th>Версия браузера</th>
		<th>ОС</th>		
	</tr>
	<?php 
	
	foreach ($resultArray as $key=>$value)
	{
	?>
	<tr>
		<td><?= $value['id'] ?></td>				
		<td><?= $value['date_add'] ?></td>
		<td><?= $value['user_ip'] ?></td>
		<td><?= $value['user_browser_name'] ?></td>
		<td><?= $value['user_browser_version'] ?></td>		
		<td><?= $value['user_browser_platform'] ?></td>				
	</tr>
	<?php 
	}		
	?>		
</table>
