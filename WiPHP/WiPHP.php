<?php
// 版本信息
const THINK_VERSION     =   '1.2.1';

// 类文件后缀
const EXT               =   '.php'; 

// 系统常量定义
defined('WIPHP_PATH')   	or define('WIPHP_PATH',     __DIR__.'/');
defined('APP_PATH')     	or define('APP_PATH',       dirname($_SERVER['SCRIPT_FILENAME']).'/');

defined('LIB_PATH')     	or define('LIB_PATH',       realpath(WIPHP_PATH.'Lib').'/'); // 系统核心类库目录

defined('CORE_PATH')		or define('CORE_PATH',		LIB_PATH.'Core/');//核心类文件路径
defined('EXTEND_PATH')		or define('EXTEND_PATH', 	LIB_PATH.'Extend/');//定义扩展类目录
defined('EXCEPTION_PATH') 	or define('EXCEPTION_PATH', LIB_PATH.'Exception/');//定义异常扩展目录
defined('DEFAULT_CONF_PATH') or define('DEFAULT_CONF_PATH', WIPHP_PATH.'Config/');//系统默认配置文件路径

defined('APP_CONF_PATH')	or define('APP_CONF_PATH', 	APP_PATH.'Config/');//项目配置文件路径
defined('APP_FUNC_PATH')	or define('APP_FUNC_PATH', APP_PATH.'Function/');//项目自定义方法路径
defined('APP_LIB_PATH')		or define('APP_LIB_PATH', 	APP_PATH.'Lib/');//项目库路径
defined('APP_SERVER_PATH')	or define('APP_SERVER_PATH',APP_LIB_PATH.'Server/');//项目控制器路径
defined('APP_MODEL_PATH')	or define('APP_MODEL_PATH',	APP_LIB_PATH.'Model/');//项目模型类路径
defined('APP_VIEW_PATH')	or define('APP_VIEW_PATH',	APP_LIB_PATH.'View/');//项目模板文件路径

defined('CONF_EXT')     	or define('CONF_EXT',       '.php'); // 配置文件后缀

defined('__APP__')			or define('__APP__',		rtrim($_SERVER['SCRIPT_NAME'],'/'));//定义当前项目根目录，不含域名

if(!defined('__ROOT__')) {
	$_root = rtrim(dirname(__APP__)).'/';
	define('__ROOT__',  (($_root=='/' || $_root=='\\')?'':$_root));
}
defined('__PUBLIC__')		or define('__PUBLIC__', 	__ROOT__.'Public/');//公共文件路径
defined('__UPLOAD__')		or define('__UPLOAD__', 	__ROOT__.'upload/');//下载文件路径

// 加载核心Think类
require CORE_PATH.'Wi'.EXT;
// 应用初始化 
Wi::start();