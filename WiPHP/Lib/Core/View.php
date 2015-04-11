<?php
/*
 * 视图类
 */
class View
{
	/*
 	* 保留View类的对象实例
 	*/
	static private $init;
	
	//赋值变量
	private $var = array();
	
	/*
 	* 在第一次调用时生成View对象，并保留在$init静态属性中
 	*/
	static public function init()
	{
		if(empty(self::$init))
		{
			self::$init = new View();
		}
		return self::$init;	
	}
	
	
	/*
	 * 变量赋值
	 */
	public function assign($name,$value)
	{
		$this->var[$name] = $value;
					
	}
	
	/*
	 * 视图显示
	 */
	public function display($viewfile)
	{
		$name=array_keys($this->var);
		foreach($name as $key)
		{
			$$key=$this->var[$key];
		}
		//设置include 路径，在模版页可以直接相对view文件夹包含文件
		set_include_path(APP_VIEW_PATH);	
		include_once APP_VIEW_PATH.$viewfile.'.phtml';
		
	}
	
	
}