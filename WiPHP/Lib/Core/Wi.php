<?php

class Wi {
	/**
  * 应用程序初始化
  * @access public
  * @return void
  */
  static public function start() {

    include WIPHP_PATH.'Common/autoload.php';//动态加载文件
		include WIPHP_PATH.'Config/config.php';//加载默认配置文件
		include WIPHP_PATH.'Common/common.php';//加载通用函数
		include WIPHP_PATH.'Common/function.php';//加载核心函数

		if(C('CHECK_APP_DIR')) {
      if(!is_dir(APP_PATH)){
      // 检测应用目录结构
        Build::checkDir();
      }
    }

    if(file_exists(APP_FUNC_PATH.'function.php'))
		  include APP_FUNC_PATH.'function.php';//加载项目自定义函数

    App::run();
    }
}