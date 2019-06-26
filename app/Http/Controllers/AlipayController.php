<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AlipayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';  //路径
    public $aliPubKey = '';  //路径
    public $privateKey = 'MIIEpAIBAAKCAQEAt5bY5lP+jedRIvIKHPYdzKDtq/j47F3O7asai0s4uNOEltedX66OzmW/V7XfLcJiV0EtQcdpWhM7RjmB2Xxvz2r4t05d2Lc+mYwHs5nuGZ9DgcMJTJ3Ai/M/4BnS1ZEsXWg5JcxFnb7Ze+HBcqg6MGTEgS/C8/7fJT/BFBa3pgJf2k41/wKt62ozdMqmOOcBoorL0nRDj/961GBNBOIDNzD8X2AyMUcEgUiKBLGUkCyVzwjErPR78DBiAz0d7e2bwirxqFtdc7AF1QzLV14hFFNe5PwZl8HXHVzb5Bo9HRwlrQEpW7n/WHiuqQQC4tkafGAGE9B0Liys/an/tslMXwIDAQABAoIBAQCqS1OguzL5gCMj7i3xVV6o7HHqPoTwA8gpb7iskrbnwtRPc2t4UJwI2hqWCo8djBzaYQvQ419W/VXTOw62pZW1ab2RkzC8EKYRmfGe6F8TB0eAO2EJ3562conCn1GRZxsm/cFczVGaFGj6X5uodmGbeC1Kw/nriHSGwc+gib4KTsFXvWWIoSdGpidwqFDEI57/cSiXRlXEuJcj3XCHCDiPFKNicDS5iDfTXHbMngG1XvyXgoNuj83ydFpSWQMEivKLFCmaeyAjLQQJ8QD+hBsEpkwoLIf/99XWPoad4DiN9GvkOZLSHLKbDSTutv7bOGrR4u+s6Cw3r9zisYxmoN0RAoGBANkhMdnVKC3eQd3UFzd2qviWYPTnusBqtG7D99CWk3c3vJ8Z+kHM2cYndNX5K4HoidkFA+IqJDgg1OEZbFeRKRAZDHDRcyWtBbk5xPnzdPHNceoyHRZf7kdSvTd6ABHuBLKzHFMXAA7ph5+OcW0sH+FSJner9/6cToL0ZAzibGEHAoGBANh0iIbFlDVFSC3HRqx4oWJu4FeZcPzZAKDWf4lG8SqVk7XOVGUK0E8xa3W3J3a8RHRFY3NckR7qPo6b+JTQ3GJu8GwIoATyOYcomApk+L8wkqlu1k2dRhFgbOCenJpf2TAb2cQDsyTCCX8SCF5G+9XI5L/xKuVtTED+Ob6GvNvpAoGBAKIeg982pZJh4eIkatVRuGR1u50ArNLgmSofDhhjZWXdauuMdOvObUfjy/u72L1diBdPBFBI0NRLx0bvOZLEYtmPKlfOO2CFKMHdHXLXUZj9obGQi2FabUo5v+f9IrJAeqeGzn5HrRZ1TXtX2t791Cvjr68o6rjjskda/J0WLn/fAoGAFVpBkZHyEeM4wJNU7HSl7vDjHqEbXUYG4tbmE+O0rK++t4OYHbOYYweMAzvDH9poolOqANpT0onnC+hk+EE2TFuHShD7wCEo/aVKglP9mdav0RkG+PcXz2UEuI/NAQmNgkptDAIVbP3bM/bSboJwG2HK9whSY/mJOSwbBCmEfekCgYA53goI5y0pWXL1zKpA7/Y1x8Bq239nnEf13Dx9uPzKWnr62TCTF7N69dpskmWWO4P9BBVFQpOFl4Htarncjtz1loQPRvSygcO3aVONbmN5fsQ3Z/53cy+Gs22vr5LdMjtffrQLJEjhyvuehV1EsClx4rcTuglXFK8491EmwwajKA==';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAt5bY5lP+jedRIvIKHPYdzKDtq/j47F3O7asai0s4uNOEltedX66OzmW/V7XfLcJiV0EtQcdpWhM7RjmB2Xxvz2r4t05d2Lc+mYwHs5nuGZ9DgcMJTJ3Ai/M/4BnS1ZEsXWg5JcxFnb7Ze+HBcqg6MGTEgS/C8/7fJT/BFBa3pgJf2k41/wKt62ozdMqmOOcBoorL0nRDj/961GBNBOIDNzD8X2AyMUcEgUiKBLGUkCyVzwjErPR78DBiAz0d7e2bwirxqFtdc7AF1QzLV14hFFNe5PwZl8HXHVzb5Bo9HRwlrQEpW7n/WHiuqQQC4tkafGAGE9B0Liys/an/tslMXwIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016092500595745';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = env('APP_URL').'/';
    }
    
    
    /**
     * 订单支付
     * @param $oid
     */
    public function pay(Request $request)
    {
        

    	// file_put_contents(storage_path('logs/alipay.log'),"\nqqqq\n",FILE_APPEND);
    	// die();
        //验证订单状态 是否已支付 是否是有效订单
        //$order_info = OrderModel::where(['oid'=>$oid])->first()->toArray();
        //判断订单是否已被支付
        // if($order_info['is_pay']==1){
        //     die("订单已支付，请勿重复支付");
        // }
        //判断订单是否已被删除
        // if($order_info['is_delete']==1){
        //     die("订单已被删除，无法支付");
        // }
        $oid=request()->input('oid');
        $data=DB::table("order")->where('oid',$oid)->first();
        // dd($oid);
        // dd($data);
        // $oid = time().mt_rand(1000,1111);  //订单编号
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => $data->pay_money,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        
        header("Location:".$url);
    }
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
    	}
        
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset($k, $v);
        return $stringToBeSigned;
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn()
    {
        header('Refresh:2;url=/order/list');
        echo "订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转';
//        echo '<pre>';print_r($_GET);echo '</pre>';die;
//        //验签 支付宝的公钥
//        if(!$this->verify($_GET)){
//            die('簽名失敗');
//        }

//        //验证交易状态
////        if($_GET['']){
////
////        }
//
//        //处理订单逻辑
//        $this->dealOrder($_GET);
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>>'.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }
        //验证订单交易状态
        if($_POST['trade_status']=='TRADE_SUCCESS'){
            //更新订单状态
            $oid = $_POST['out_trade_no'];     //商户订单号
            $info = [
                'state'        => 1,       //支付状态  0未支付 1已支付
                // 'pay_amount'    => $_POST['total_amount'] * 100,    //支付金额
                // 'pay_time'      => strtotime($_POST['gmt_payment']), //支付时间
                // 'oid'      => $_POST['trade_no'],      //支付宝订单号
                // 'plat'          => 1,      //平台编号 1支付宝 2微信 
            ];
            DB::table('order')->where(['oid'=>$oid])->update($info);
        }
        //处理订单逻辑
        $this->dealOrder($_POST);
        echo 'success';
    }
   function verify($params) {
        $sign = $params['sign'];

        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }
        
        
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        
        if(!$this->checkEmpty($this->aliPubKey)){
            openssl_free_key($res);
        }
        return $result;
    }
    /**
     * 处理订单逻辑 更新订单 支付状态 更新订单支付金额 支付时间
     * @param $data
     */
    public function dealOrder($data)
    {
        //加积分
        //减库存
    }
    public function quit(Request $request){
    	$quit=$request->session->flush();
    	dd($quit);
    }
}
