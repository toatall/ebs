<?php

class Login extends Model
{
	
	public $username;
	public $password;
	
	
	
	public function labels()
	{
		return [
			'username' => 'Логин',
			'password' => 'Проль',
		];
	}
	
	
	public function rules()
	{
		return [
			'require' => ['username', 'password'],		
		];
	}
	
	
	public function validate()
	{		
		parent::validate();
		if (!count($this->validErrors))
		{
			if (!$this->authenticate()) 
			$this->validErrors[] = 'Неверный логин или пароль!';
		}
		
	}
	
	
	private function authenticate()
	{
		$logins = $this->listUsers();
				
		if (array_key_exists($this->username, $logins))
		{		
			var_dump($logins[$this->username]['password']);
			if ($logins[$this->username]['password'] === $this->password)
			{
				$_SESSION['isLogin'] = true;
				$_SESSION['username'] = $this->username;
				$_SESSION['sono'] = $logins[$this->username]['sono'];
				return true;
			}
		}
		
		return false;
	}
	
	
	
	private function listUsers()
	{
		return [
			// учетка УФНС
			'user' => array('password'=>'qazwsxedc', 'sono'=>'8600'),
	
			// учетки ИФНС
			'user01' => array('password'=>'681505', 'sono'=>'8601'),
			'user02' => array('password'=>'334099', 'sono'=>'8602'),
			'user03' => array('password'=>'348038', 'sono'=>'8603'),
			'user06' => array('password'=>'931482', 'sono'=>'8606'),
			'user07' => array('password'=>'207119', 'sono'=>'8607'),
			'user08' => array('password'=>'655174', 'sono'=>'8608'),
			'user10' => array('password'=>'497884', 'sono'=>'8610'),
			'user11' => array('password'=>'167588', 'sono'=>'8611'),
			'user17' => array('password'=>'462780', 'sono'=>'8617'),
			'user19' => array('password'=>'604074', 'sono'=>'8619'),
			'user22' => array('password'=>'379148', 'sono'=>'8622'),
			'user24' => array('password'=>'778823', 'sono'=>'8624'),
		];
	}
	
	
	public function isLogin()
	{		
		return isset($_SESSION['isLogin']);
	}
	
	public function logout()
	{
		if (isset($_SESSION['isLogin']))
			unset($_SESSION['isLogin']);
		if (isset($_SESSION['username']))
			unset($_SESSION['username']);
		if (isset($_SESSION['sono']))
			unset($_SESSION['sono']);
	}
	
	
}