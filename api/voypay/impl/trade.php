<?php
/**
 * Created by PhpStorm.
 * User: jianzhi
 * Date: 2017/8/14
 * Time: 18:34
 */
class impl_trade extends impl_base{
    public function get($param){
        $appId = 'trade.get';
        return $this->callRemoteMethod($appId, $param);
    }
    public function submit($param){
        $appId = 'trade.submit';
        return $this->callRemoteMethod($appId, $param);
    }
}