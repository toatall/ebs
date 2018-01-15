
<!-- form class="form-signin" action="" method="post">
	<h2 class="form-signin-heading">Аутентификация</h2>
    <label for="username" class="sr-only">Логин</label>
    <input id="username" name="Login[username]" class="form-control" placeholder="Логин" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="Login[password]" id="password" class="form-control" placeholder="Пароль" required>  
    <br />      
    <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
</form-->




	<form class="form-signin well" method="post">		
		<h2>Вход</h2><hr />		
		<?= CHtml::summaryValidError($model) ?>
		<?= CHtml::inputText($model, 'username', 'text', ['input' => 'class="form-control" placeholder="Логин" required autofocus']) ?><br />
		<?= CHtml::inputText($model, 'password', 'password', ['input' => 'class="form-control" placeholder="Пароль" required']) ?><br />
		<?= CHtml::buttonSubmit('Вход') ?>
	</form>
