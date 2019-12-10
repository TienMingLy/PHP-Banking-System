<?php

class Controller 
{
	public function model($model)
	{
		require_once 'app/models/' . $model . '.php';
		return new $model();
	}

	public function view($view, $data = []) // this is how we pass the data to view
	{
		require_once 'app/views/' . $view . '.php'; 
	}
}