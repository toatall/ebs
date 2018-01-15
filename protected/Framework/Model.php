<?php

class Model
{
	protected $validErrors = [];
	
	public function getPostData()
	{
		print_r($this);
		
	}
	
	
	public function getErrors()
	{
		return $this->validErrors;
	}
	
	
	public function validate()
	{
		$rules = $this->rules();
		
		if (isset($rules['require']))
		{
			foreach ($rules['require'] as $attr)
			{
				if (empty($this->$attr))
					$this->validErrors[] = 'Поле "' . $this->attributeText($attr) . '" обязательно для заполнения';
			}
		}
		
	
		if (isset($rules['length']) && isset($rules['length']['attributes']) 
			&& (isset($rules['length']['min']) || isset($rules['length']['max'])))
		{
			foreach ($rules['length']['attributes'] as $attr)
			{
				if (isset($rules['length']['min']) && strlen($this->$attr) < $rules['length']['min'])
				{
					$this->validErrors[] = 'Поле "' . $this->attributeText($attr) 
						. '" должно содержать не менее ' . $rules['length']['min'] . ' символов';
				}
				
				if (isset($rules['length']['max']) && strlen($this->$attr) > $rules['length']['max'])
				{
					$this->validErrors[] = 'Поле "' . $this->attributeText($attr) 
						. '" должно содержать не более ' . $rules['length']['max'] . ' символов';
				}
			}			
		}
		
		
		if (isset($rules['numeric']))
		{
			foreach ($rules['numeric'] as $attr)
			{
				if (!is_numeric($this->$attr))
					$this->validErrors[] = 'Поле "' . $this->attributeText($attr) . '" должно содержать только цифры';
			}
		}
		
		if (count($this->validErrors))
			return false;
		
		return true;
		
	}
	
	
	
	
	public function rules() { return []; }
	
	
	public function attributeText($attr)
	{
		return isset($this->labels()[$attr]) ? $this->labels()[$attr] : $attr;
	}
	
	
}