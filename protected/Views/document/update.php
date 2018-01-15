<ol class="breadcrumb">
  <li><a href="<?= Route::createUrl('admin/index') ?>">Главная</a></li>
  <li>Изменить документ #<?= $model->id ?></li>  
</ol>



<h3>Изменить документ</h3>

<?php 
	require 'protected/Views/document/_form.php';
?>