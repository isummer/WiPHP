<?php
class Build {

    static protected $server   =   '<?php
    class [SERVER]Server extends Server {
    public function index(){
        $this->show(\'<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>WiPHP</b>！</p><br/>[ 您现在访问的是[SERVER]控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>\',\'utf-8\');
    }
}';

    static protected $model         =   '<?php
    class [MODEL]Model extends Model {

}';
    // 检测应用目录是否需要自动创建
    static public function checkDir(){
        if(!is_dir(APP_PATH)) {
            // 创建模块的目录结构
            self::buildAppDir();
        }
    }

    // 创建应用和模块的目录结构
    static public function buildAppDir() {
        // 没有创建的话自动创建
        if(!is_dir(APP_PATH)) mkdir(APP_PATH,0755,true);
        if(is_writeable(APP_PATH)) {
            $dirs  = array(
                APP_PATH,
                APP_CONF_PATH,
                APP_FUNC_PATH,
                APP_LIB_PATH,
                APP_SERVER_PATH,
                APP_MODEL_PATH,
                APP_VIEW_PATH,
                );
            foreach ($dirs as $dir){
                if(!is_dir($dir))  mkdir($dir,0755,true);
            }

            // 写入应用配置文件
            if(!is_file(APP_CONF_PATH.'config.php'))
                file_put_contents(APP_CONF_PATH.'config.php',"<?php\nreturn array(\n\t//'配置项'=>'配置值'\n);");
            // 写入自定义方法文件
            if(!is_file(APP_CONF_PATH.'config.php'))
                file_put_contents(APP_FUNC_PATH.'function.php',"<?php\nphp?>");
            // 生成模块的测试控制器
            if(defined('BUILD_SERVER_LIST')){
                // 自动生成的控制器列表（注意大小写）
                $list = explode(',',BUILD_SERVER_LIST);
                foreach($list as $server){
                    self::buildServer($server);
                }
            }else{
                // 生成默认的控制器
                self::buildServer();
            }
            // 生成模块的模型
            if(defined('BUILD_MODEL_LIST')){
                // 自动生成的控制器列表（注意大小写）
                $list = explode(',',BUILD_MODEL_LIST);
                foreach($list as $model){
                    self::buildModel($model);
                }
            }            
        }else{
            header('Content-Type:text/html; charset=utf-8');
            exit('应用目录['.APP_PATH.']不可写，目录无法自动生成！<BR>请手动生成项目目录~');
        }
    }

    // 创建控制器类
    static public function buildServer($server='Index') {
        $file   =   APP_LIB_PATH.'Server/'.$server.'Server'.EXT;
        if(!is_file($file)){
            $content = str_replace(array('[SERVER]'),array($server),self::$server);
            file_put_contents($file,$content);
        }
    }

    // 创建模型类
    static public function buildModel($model) {
        $file   =   APP_LIB_PATH.'Model/'.$model.'Model'.EXT;
        if(!is_file($file)){
            $content = str_replace(array('[MODEL]'),array($model),self::$model);
            file_put_contents($file,$content);
        }
    }
}