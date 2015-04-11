<?php
defined('WIPHP_PATH') or exit();
return  array(

    /* 默认设定 */
    'DEFAULT_M_LAYER'       =>  'Model', // 默认的模型层名称
    'DEFAULT_C_LAYER'       =>  'Server', // 默认的控制器层名称
    'DEFAULT_V_LAYER'       =>  'View', // 默认的视图层名称
    'DEFAULT_MODULE'        =>  'server',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      =>  'PRC',	// 默认时区
    'DEFAULT_AJAX_RETURN'   =>  'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
    'DEFAULT_JSONP_HANDLER' =>  'jsonpReturn', // 默认JSONP格式返回的处理方法
    'DEFAULT_FILTER'        =>  'htmlspecialchars', // 默认参数过滤方法 用于I函数...

    /* 数据库设置 */
    'DB_TYPE'               =>  '',     // 数据库类型
    'DB_HOST'               =>  '', // 服务器地址
    'DB_NAME'               =>  '',          // 数据库名
    'DB_USER'               =>  '',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存

    /* 错误设置 */
    'ERROR_MESSAGE'         =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'            =>  '',	// 错误定向页面
    'SHOW_ERROR_MSG'        =>  false,    // 显示错误信息
    'TRACE_MAX_RECORD'      =>  100,    // 每个级别的错误信息 最大记录数


    /* SESSION设置 */
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
   
    /* 模板引擎设置 */
    'TMPL_CONTENT_TYPE'     =>  'text/html', // 默认模板输出类型
    'TMPL_TEMPLATE_SUFFIX'  =>  '.html',     // 默认模板文件后缀
    'TMPL_FILE_DEPR'        =>  '/', //模板文件CONTROLLER_NAME与ACTION_NAME之间的分割符


    /* 系统变量名称设置 */
    'VAR_MODULE'            =>  'm',     // 默认模块获取变量
    'VAR_ADDON'             =>  'addon',     // 默认的插件控制器命名空间变量
    'VAR_SERVER'        =>  's',    // 默认控制器获取变量
    'VAR_ACTION'            =>  'a',    // 默认操作获取变量

    'CHECK_APP_DIR'         =>   true
);
