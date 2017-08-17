<?php
/**
 * Created by PhpStorm.
 * User: jianzhi
 * Date: 2017/8/14
 * Time: 19:13
 */
abstract class impl_base{
    private function getConfig(){
        return l::getConfig('payment');
    }
    public function callRemoteMethod($appId, $param = array()){
        $config = $this->getConfig();

        //$appId = 'trade.credit';
        $merId = $config['mer_no'];
        $merkey  = $config['mer_key'];
        $url  = !empty($url)? $url: $config['url'];

        $content = trim(json_encode($param,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        p($content,'请求参数');
        $headers =  array();

        $headers[] = "MerId: ".$merId;
        $headers[] = "AppId: ".$appId;
        $headers[] = "Signature: " . hash('sha256', $merkey.$content);
        $headers[] = "Expect: ";
        $mothed = 'POST';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIMEOUT);
        // curl_setopt($ch, CURLOPT_TIMEOUT, self::PROCESS_TIMEOUT);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt ($ch,CURLOPT_REFERER,'http://localhost/');
        //curl_setopt($ch, CURLOPT_NOSIGNAL, true);

        $res = curl_exec($ch);
        p($res,'响应参数');

        //$res = explode( "\r\n",$res);
        //p($res,'响应参数解析');

        //p(curl_getinfo($ch),'curl_getinfo');
        curl_close($ch);

        return $res;
    }
}