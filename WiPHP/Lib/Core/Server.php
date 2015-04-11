<?php
class Server
{
	protected $view;
	
	public function __construct()
	{
		
	}
	
	private function view_init()
	{
		$this->view = View::init();
	}
	protected function success($message,$url=null)
	{
		echo "<script>alert('$message');</script>";
		if(isset($url))
		{
			jumpUrl($url);
		}
		else 
		{
			echo "<script>history.back();</script>";
		}
	}
	
	protected function error($message,$url=null)
	{
		echo "<script>alert('$message');</script>";
		if(isset($url))
		{
			jumpUrl($url);
		}
		else 
		{
			echo "<script>history.back();</script>";
		}
	}
	
	protected function assign($name,$value)
	{
		$this->view_init();
		$this->view->assign($name, $value);
	}
	
	protected function display($filename) 
	{
		$this->view_init();
		$this->view->display($filename);
	}

	protected function show($html)
	{
		print($html);
	}

	protected function render()
	{
		
	}
	
	
	
	
}