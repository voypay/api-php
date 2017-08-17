<?php
class l{
    /*
     * 配置
     */
    static private $config;

    /**
     * @param array $config
     */
    static public function init($config = array()){
        static $firstTime = true;
        if (!$firstTime) {
            return;
        }
        self::$config = $config;
        spl_autoload_register(array('l', 'loadFile'));
    }

    /**
     * 文件加载
     * @param $classname
     * @return mixed
     * @throws Exception
     */
    static private function loadFile($name){
        $classPath = str_replace('_',  DIRECTORY_SEPARATOR, strtolower($name));

        if (strpos($name, 'impl') === false) {
            throw new Exception('load file: "' . $name . '" is fail!!');
        }
        //设置文件加载目录
        $filepath = dirname(__FILE__). DIRECTORY_SEPARATOR.'voypay';
        $filename = strtolower($filepath . DIRECTORY_SEPARATOR . $classPath . '.php');
        if (file_exists($filename)) {
            return require_once $filename;
        }
        else{
            throw new Exception('load file: "' . $name . '" is fail!');
        }
    }
    /**
     * 类加载函数
     * @param $name 类名称
     * @return object
     * @throws Exception
     */
    static private function load($name){

        $name = str_replace('.', '_',$name);

        static $objects;
        if (isset($objects[$name])) {
            return $objects[$name];
        }
        self::loadFile($name);
        if (!class_exists($name, false)) {
            throw new Exception('load class: "' . $name . '" is fail!');
        }
        $objects[$name] = new $name();

        return $objects[$name];
    }

    static public function getImpl($name){
        $name = str_replace('.','_',$name);
        $objname = 'impl_' . $name;
        return self::load($objname);
    }

    /**
     * 配置文件
     * @param $option
     * @param null $key
     * @return mixed
     */
    static public function getConfig($option, $key = null){
        if (self::$config){
            if ($key){
                return self::$config[$option][$key];
            }
            else{
                return self::$config[$option];
            }
        }
    }
}
function p($vars, $label = '', $return = false){
    if (ini_get('html_errors')) {
        $content = "<pre style='text-align:left'>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}