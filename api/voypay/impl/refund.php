<?php
/**
 * Created by PhpStorm.
 * User: jianzhi
 * Date: 2017/8/14
 * Time: 19:10
 */
class impl_refund extends impl_base{
    public function get($param){
        $appId = 'refund.get';
        return $this->callRemoteMethod($appId, $param);
    }
    public function submit($param){
        $appId = 'refund.submit';
        return $this->callRemoteMethod($appId, $param);
    }
}