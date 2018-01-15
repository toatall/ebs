<form class="form well" enctype="multipart/form-data" method="post">
	
	<?= CHtml::summaryValidError($model) ?>
	
	<?= CHtml::dropDownList($model, 'typeNp', $model->listNP(), ['input'=>' class="form-control"']) ?>
	<?= CHtml::inputText($model, 'innNp','text',['input' => 'class="form-control" placeholder="ИНН" required autofocus']) ?>
	<?= CHtml::inputText($model, 'fileNp', 'file', ['input' => 'class="form-control" placeholder="Файл" required autofocus']) ?>
	<?= CHtml::textArea($model, 'description', ['input'=>'class="form-control" rows="3"']) ?><br />
	<?= CHtml::buttonSubmit(($model->isNewRecord) ? 'Создать' : 'Изменить', ' class="btn btn-primary"') ?>
	<?= CHtml::button('Отмена', '#', 'btn btn-danger', ' onclick="js: window.history.back(); return false;"') ?>
</form>