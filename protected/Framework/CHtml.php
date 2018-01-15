<?php

class CHtml
{
	
	public static function inputText($model, $attribute, $type='text', $options=null)
	{
		$labelOptions = isset($options['label']) ? ' ' . $options['label'] : '';
		$inputOptions = isset($options['input']) ? ' ' . $options['input'] : '';
		
		$labelText = (isset($model->labels()[$attribute]) ? $model->labels()[$attribute] : $attribute);
		$classModel = get_class($model);
		
		$inputValue = !empty($model->$attribute) ? ' value="' . $model->$attribute . '" ' : '';
		
		return "<label for=\"{$classModel}_{$attribute}\"{$labelOptions}>{$labelText}</label>\n
    			<input type=\"{$type}\" id=\"{$classModel}_{$attribute}\" name=\"{$classModel}[{$attribute}]\"{$inputValue}{$inputOptions}>";
		
	}
	
	
	
	
	public static function buttonSubmit($label, $options = ' class="btn btn-lg btn-primary btn-block"')
	{
		return "<button{$options} type=\"submit\">{$label}</button>";
	}
	
	
	public static function summaryValidError($model)
	{
		if (count($model->getErrors()))
			return '<div class="alert alert-danger">' . implode('<br />', $model->getErrors()) . '</div>';
	}
	
	
	
	public static function dropDownList($model, $attribute, $dataArray, $options=null)
	{
				
		$labelOptions = isset($options['label']) ? ' ' . $options['label'] : '';
		$inputOptions = isset($options['input']) ? ' ' . $options['input'] : '';
		
		$labelText = (isset($model->labels()[$attribute]) ? $model->labels()[$attribute] : $attribute);
		$classModel = get_class($model);
		
		$data = '';
		foreach ($dataArray as $key=>$value)
		{			
			$selected = ($model->$attribute == $key) ? ' selected="selected"' : '';
			$data .= "<option value=\"{$key}\"{$selected}>$value</option>\n";
		}
		
		return "<label for=\"{$classModel}_{$attribute}\"{$labelOptions}>{$labelText}</label>\n
				<select id=\"{$classModel}_{$attribute}\" name=\"{$classModel}[{$attribute}]\"{$inputOptions}>".$data."</select>";
	}
	
	
	
	public static function textArea($model, $attribute, $options=null)
	{
		$labelOptions = isset($options['label']) ? ' ' . $options['label'] : '';
		$inputOptions = isset($options['input']) ? ' ' . $options['input'] : '';
		
		$labelText = $model->attributeText($attribute);
		$classModel = get_class($model);
		
		return "<label for=\"{$classModel}_{$attribute}\"{$labelOptions}>{$labelText}</label>\n
			   <textarea id=\"{$classModel}_{$attribute}\" name=\"{$classModel}[{$attribute}]\"{$inputOptions}>{$model->$attribute}</textarea>";			
		
	}
	
	
	public static function button($attribute, $url, $btnClass = 'btn btn-primary', $options=null)
	{
		return '<a href="' . $url . '" class="' . $btnClass . '"' . $options . '>' . $attribute . '</a>';
	}
	
	
}