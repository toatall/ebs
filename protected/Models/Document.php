<?php

class Document extends Model
{
	
	public $id;
	public $typeNp;
	public $innNp;
	public $fileNp;
	public $description;
	public $isNewRecord;
	
	public function labels()
	{
		return [
			'typeNp' => 'Тип налогоплательщика',
			'innNp' => 'ИНН налогоплательщика',
			'fileNp' => 'Файл для загрузки',
			'description' => 'Описание',
		];
	}
	
	
	public function rules()
	{
		return [
			'require' => ['typeNp', 'innNp'],
			'length' => ['min'=>'10', 'max'=>'12', 'attributes'=>['innNp']],
			'numeric' => ['innNp'],
		];
	}
	
	
	public function save()
	{
			
		if (!$this->validate())
			return false;
		
		$sql = new MSSQL();
		
		if ($this->isNewRecord)
		{
			$scriptSQL = "insert into EBS_FILES ([guid],[filename],[inn],[status_np],[description],[sono]) "
			. "select left(cast(newid() as varchar(36)),8), '{$this->fileNp}', '{$this->innNp}', "
			. "{$this->typeNp},'{$this->description}',{$_SESSION['sono']}";
		}
		else 
		{
			$scriptSQL = "update EBS_FILES set [filename]='{$this->fileNp}', [inn]='{$this->innNp}', "
				."[status_np]={$this->typeNp}, description='{$this->description}' where id={$this->id}";
		}
		
		if (!$sql->execSQL($scriptSQL))
		{
			$this->validErrors[] = 'Ошибка сохранения в БД. ' . $sql->getErrors();
			return false;
		}
		return true;		
	}
	
	
	public function validate()
	{
		if (parent::validate())
		{
			$this->loadFile();
		}
				
		if (count($this->validErrors))
			return false;
		
		return true;
	}
	
	
	private function loadFile()
	{
		$folder  = Config::params()['upploadDir'];
		if (!is_dir($folder)) { mkdir($folder); }
		$uploadedFile = iconv('utf-8', 'windows-1251', $folder . basename($_FILES['Document']['name']['fileNp']));
		
		
		if (!$this->isNewRecord)
		{
			$oldFile = iconv('utf-8', 'windows-1251', $folder . basename($this->fileNp));
			if (file_exists($oldFile))
				unlink($oldFile);
		}
		
		if (file_exists($uploadedFile))
		{
			$this->validErrors[] = "Файл " . $_FILES['Document']['name']['fileNp'] . " уже существует!";
			return;
		}
		
		if (!is_uploaded_file($_FILES['Document']['tmp_name']['fileNp'])) 
		{
			$this->validErrors[] = "Ней удалось загрузить файл " . $_FILES['Document']['name']['fileNp'] . "!";
			return;
		}
		
		if (!move_uploaded_file($_FILES['Document']['tmp_name']['fileNp'], $uploadedFile))	
		{
			$this->validErrors[] = "Не удалось переместить файл " . $_FILES['Document']['name']['fileNp'] . "!";
			return;
		}
		
		$this->fileNp = Config::params()['fileLink'] . $_FILES['Document']['name']['fileNp'];
		
	}
		
	
	
	public function listNP()
	{
		return [
			1 => 'ЮЛ',
			2 => 'ФЛ',
			3 => 'ИП',
		];
	}
	
	
	
	public function loadFromBase($id)
	{
		$sql = new MSSQL();
		$result = $sql->querySQL("select * from EBS_FILES where id=" . $id . " and sono='" . $_SESSION['sono'] . "'");
		if (!$result)
			return false;
				
		$this->id = $result[0]['id'];
		$this->typeNp = $result[0]['status_np'];
		$this->innNp = $result[0]['inn'];
		$this->fileNp = $result[0]['filename'];
		$this->description = $result[0]['description'];
		return true;		
		
	}
	
	public function delete($id)
	{
		$this->deleteFile();
		$sql = new MSSQL();
		return $sql->execSQL("delete from EBS_FILES where id=" . $id . " and sono='" . $_SESSION['sono'] . "'");
	}
	
	private function deleteFile()
	{
		$file = iconv('utf-8', 'windows-1251', Config::params()['upploadDir'] . basename($this->fileNp)); 		
		if (file_exists($file))
			unlink($file);
	}
		
	
	
	
}