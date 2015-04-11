<?php
class App
{
	static public function run()
	{
		$sid = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : null;
		if ($sid)
		{
			session_id($sid);
		} 
		session_start();	//开启session
		try
		{
			$dispatcher = new Dispatcher();
		}
		catch(UrlException $e)
		{
			echo '您访问的页面不存在！';
		}
	}
}