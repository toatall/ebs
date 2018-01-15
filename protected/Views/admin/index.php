<?php 

	require 'protected/Views/admin/_dialogStatistic.php';
	
	
	$sql = new MSSQL();
	$num = Config::params()['countRowsTable'];
		
	$page = 1;
	if (isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$page = $_GET['page'];
	}
	
	
	$resultArray = $sql->querySQL("SELECT COUNT(*) as [count] FROM [EBS_FILES] WHERE [sono]='".$_SESSION['sono']."'");
	if (count($resultArray))
	{
		// Находим общее число страниц
		$total = intval(($resultArray[0]["count"] - 1) / $num) + 1;
		// Определяем начало сообщений для текущей страницы
		$page = intval($page);
		// Если значение $page меньше единицы или отрицательно
		// переходим на первую страницу
		// А если слишком большое, то переходим на последнюю
		if (empty($page) or $page < 0) $page = 1;
		if ($page > $total) $page = $total;
		// Вычисляем начиная к какого номера
		// следует выводить сообщения
		$start = $page * $num - $num;
		// Выбираем $num сообщений начиная с номера $start
	}
	else
	{
		$start = 0; $total = 0;
	}
	
	
	
	$query = "SELECT top $num t.[id], [guid], [filename], [inn], 
			case when [status_np] = 1 then 'ФЛ' when [status_np] = 2 then 'ЮЛ' when [status_np] = 3 then 'ИП' end [status_np], [description], "
			."(convert(varchar(10),[date_add],104) + ' ' + convert(varchar(10),[date_add],108)) as [date_add],
			(select count(*) from [EBS_FILES_LOG] where [file_id] = t.[id]) [count_download] \n"
			."	 FROM [EBS_FILES] t \n"
			."WHERE [sono]='".$_SESSION['sono']."' AND [id] NOT IN ( \n"
				."	SELECT top $start [id] FROM [EBS_FILES] WHERE [sono]='".$_SESSION['sono']."' ORDER BY convert(datetime,[date_add],112) DESC \n"
			.") ORDER BY convert(datetime,[date_add],112) DESC";
	
	
	$resultArray = $sql->querySQL($query);

?>

<ol class="breadcrumb">
  <li>Главная</li>  
</ol>


<?= CHtml::button('Добавить документ', Route::createUrl('document/create')) ?><br /><br />

<table class="table table-bordered table-hover">
	<tr>
		<th>ИД</th>		
		<th>Имя файла</th>
		<th>Тип НП</th>
		<th>ИНН</th>
		<th>Ссылка для пользователя</th>
		<th>Описание</th>
		<th>Дата и время загрузки</th>		
		<th>Функции</th>
	</tr>
	<?php 
	
	foreach ($resultArray as $key=>$value)
	{
	?>
	<tr>
		<td><?= $value['id'] ?></td>		
		<td><?= basename($value['filename']) ?></td>
		<td><?= $value['status_np'] ?></td>
		<td><?= $value['inn'] ?></td>
		<td>http://213.24.61.170:3535/EBS/?<?= $value["guid"]; ?></td>		
		<td><?= $value['description'] ?></td>
		<td><?= $value['date_add'] ?></td>		
		<td>
			<a href="<?= Route::createUrl('document/update', ['id'=>$value['id']]) ?>" alt="Изменить" title="Изменить"><i class="glyphicon glyphicon-pencil"></i></a>
			<a href="<?= Route::createUrl('document/delete', ['id'=>$value['id']]) ?>" alt="Удалить" title="Удалить" onclick="js: return confirm('Вы уверены, что хотите удалить?');">
				<i class="glyphicon glyphicon-trash"></i></a>
			<a href="#" alt="Скачано" title="Скачано" class="label label-warning" data-toggle="modal" onclick="loadStatistic(<?= $value['id'] ?>)" data-target=".bs-statistic"><?= $value['count_download'] ?></a>
		</td>
		
	</tr>
	<?php 
	}
	
	?>		
</table>


<?php if ($total>1): ?>
<div class="btn-group" role="group" aria-label="First group"> 
	<?php 
	for ($i=1; $i<=$total; $i++)
	{
?>		
		<?php if ($i == $page)
		{
			echo '<span type="button" class="btn btn-default active">' . $i . '</span>';
		}
		else 
		{
			echo '<a type="button" class="btn btn-default" href="' . Route::createUrl(null, ['page'=>$i]) . '">' . $i .'</a>';
		}
	?>	
<?php 		
	}
	?>
</div>
<?php endif; ?>


