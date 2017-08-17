<?php
/**
 * Created by PhpStorm.
 * User: jianzhi
 * Date: 2017/8/14
 * Time: 19:10
 */
class impl_chargeback extends impl_base{
    public function get($param){
        $appId = 'chargeback.get';
        return $this->callRemoteMethod($appId, $param);
    }
}