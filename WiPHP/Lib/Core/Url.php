<?php
class Url
{
	static function getUrl()
	{
		$suffix = C('ACTION_SUFFIX') ? C('ACTION_SUFFIX') : '';
		$url = ".";
		if(!empty($_SERVER['PHP_SELF']))
		{
			$url = str_replace(__APP__, ".", $_SERVER['PHP_SELF']);
		}
		$split = split('/', $url);
		switch (count($split)) {
			case 1:
				$url = APP_PATH.'Index/index';
				break;
			case 2:
				if ($split[1]=='') {
					$url = APP_PATH.'Index/index';
				}
				elseif ($split[1]==APP_NAME) {
				 	$url = $url.'/Index/index';
				 };break;
			case 3:
				if ($split[2]=='') {
					$url = $url.'Index/index';
				}
				else {
					$url = $url.'/index';
				};break;
			case 4:
				if ($split[3]=='') {
					$url = $url.'index';
				};break;
		}
		if(count($split)>1 && $split[1]!='' && $split[1]!=APP_NAME) {
			$url = "./#/#/#";
		}
		return $url.$suffix;
	}
	
	static public function getUrlArray()
	{
		return explode('/',Url::getUrl());
	}
	
	//获取主机名
	static public function getHostName()
	{
		return $_SERVER['SERVER_NAME'];
	}
	
	//获取执行脚本名
	static public function getScriptName()
	{
		return $_SERVER['SCRIPT_NAME'];
	}
	
}