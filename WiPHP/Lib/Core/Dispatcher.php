<?php
class Dispatcher
{
	private $module;
	private $server;
	private $action;
	private $query;
	private $urlArray;
	
	public function __construct()
	{
		$this->getUrlArray();

		//print_r($this->urlArray);

		$this->module = $this->getModule();
		$this->server = $this->getServer().'Server';
		$this->action = $this->getAction();
		$this->query = $this->getValue();
		
		//检测控制器与方法是否存在
		$result = method_exists($this->server, $this->action);

		if($result)
		{
			$server = new $this->server();
			$action=$this->action;
			$server->$action($this->query);
		}
		else 
		{
			throw new UrlException("页面访问出错");
		}
	}

	/*
	 * 获取模块
	 */
	public function getModule()
	{
		return $this->urlArray[1];
	}
	
	/*
	 * 获取模块控制器
	 */
	public function getServer()
	{
		return $this->urlArray[2];
	}
	
	/*
	 * 获取控制器方法
	 */
	public function getAction()
	{
		if(isset($this->urlArray[3]))
		{
			return $this->urlArray[3];
		}
		else 
		{
			return C('DEFAULT_ACTION');		//如果未指定动作，则返回默认动作（Action)
		}	
	}
	
	/*
	 * 获取控制器方法之后的第一个参数
	 */
	public function getValue()
	{
		if(isset($this->urlArray[4]))
		{
			return $this->urlArray[4];
		}
		else 
		{
			return null;
		}
		
	}
	
	public function getUrlArray()
	{
		return $this->urlArray = Url::getUrlArray();
	}
}