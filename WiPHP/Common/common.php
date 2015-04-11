<?php
/*
 * C 获取配置文件配置数据
 */
function C($name,$value=null)
{
	$config_default = include DEFAULT_CONF_PATH.'config.php';
	$config_app = array();
	if(is_dir(APP_CONF_PATH))
		$config_app = include APP_CONF_PATH.'config.php';
	$config = array_merge($config_default,$config_app);
	
	if(array_key_exists($name, $config))
	{
		if($value==null)
		{
			return $config[$name];
		}
		else 
		{
			return $config[$name]=$value;
		}
	}
	else 
	{
		return false;
	}
}

/*
 * 实例化模型类
 */
function M($model)
{
	$config = C('DB');		
	$table = $config['PREFIX'].strtolower($model);	
	$model = $model.'Model';
	return new $model($table);
}

/*
 * 导入扩展
 */
function import($class,$extendPath=EXTEND_PATH)
{
	$classFile = $extendPath.$class.'.php';
	if(file_exists($classFile))
	{
		include_once $classFile;
	}
	else 
	{
		return false;
	}
}