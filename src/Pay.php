<?php 

namespace Tmtpay;

use TmtPay\Storage\PayModelInterface;
use TmtPay\Exception\TmtException;

class Pay
{   
    /**
     * DB对象
     * @var object
     */
    public $payModel;

    /**
     * 支持的支付方式
     * @var array
     */
    private $supprotPayMethod = [];

    /**
     * 支付时必需的初始化参数
     */
    public function __construct(PayModelInterface $payModel)
    {
        $this->payModel = $payModel;
    }

    /**
     * 生成订单ID
     * @return
     */
    public function GenerateOrderId($inputData)
    {
        //校验
        //生成订单号
        //生成支付号
        //入库
        $orderData = $inputData;
        $this->payModel->CreateOrder($orderData);
    }

    /**
     * 修改订单ID
     * @param  integer $order_id tmtpost订单ID
     * @return bool
     */
    public function ChangePayMethod($orderId)
    {

    }

    /**
     * 生成支付凭据
     * @param  integer $order_id tmtpost订单ID
     * @return array
     */
    public function GenerateProof($orderId)
    {
        $orderData = $this->payModel->getOrderDataById($orderId);
        $payMethod = $orderData->payment_method;
        //校验支付方式是否支持
        $this->IsSupportPayMethod($payMethod);
        //通过支付方式分发调用不同支付SDK获取支付凭据
        $this->GetProofByMethod($orderData, $payMethod);
    }


    /**
     * 校验是否支持支付方式
     * @param  string $payMethod
     * @return boolean
     */
    public function IsSupportPayMethod($payMethod)
    {
        $this->supprotPayMethod = [
            'weixin', //微信扫码支付
            'weixin_jsapi', //微信浏览器内支付
            'weixin_app', //第三方应用内微信支付
            'alipay', //支付宝扫码支付
            'alipay_wap', //支付宝wap端支付
            'alipay_app', //第三方引用内支付宝支付
        ];
        if (!in_array($payMethod, $this->supprotPayMethod)) {
            throw new TmtException("error:10010", "not supprot payMethod", 406);
        }
        return true;
    }


    /**
     * 通过支付方式分发调用不同支付SDK获取支付凭据
     * @param object $orderData 订单详情对象
     * @param string $payMethod 支付渠道
     * @param array  $extra 个别支付渠道需要的额外参数，比如weixin_jsapi中要求额外传递openid, 支付宝要求传递的回调地址
     */
    public function GetProofByMethod($orderData, $payMethod, $extra = [])
    {
        switch ($payMethod) {
            case 'weixin':
                $proof = $this->generate_weixin_summit($orderData, $payMethod);
                break;
            case 'alipay':

                break;
            default:
                throw new TmtException("error:10010", "not supprot payMethod", 406);
                break;
        }
        return $proof;
    }

    /**
     * 获取微信扫码支付凭据
     * @param object $orderData 订单详情对象
     * @param string $payMethod 支付渠道
     */
    private function generate_weixin_summit($orderData, $payMethod)
    {
        $notify = new \NativePay();
        /**
         * 商品描述
         */
        $body = $orderData['order_title'];
        /**
         * 附加数据
         * @var [type]
         */
        $attach       = isset($orderData['attach']) ? $orderData['attach'] : NULL; 
        $out_trade_no = $orderData['order_id'];
        $total_fee    = $orderData['actual_price'];
        $time_start   = date('YmdHis',$orderData['time_start']);
        $time_expire  = date('YmdHis',$orderData['time_expire']);
        $goods_tag    = isset($orderData['goods_tag']) ? $orderData['goods_tag'] : NULL; 
        $notify_url   = \WxPayConfig::NOTIFY_URL;
        $trade_type   = 'NATIVE';
        $product_id   = $orderData['goods_guid'];

        $input = new \WxPayUnifiedOrder();
        $input->SetBody($body);
        $input->SetAttach($attach);
        $input->SetOut_trade_no($out_trade_no);
        $input->SetTotal_fee($total_fee);
        $input->SetTime_start($time_start);
        $input->SetTime_expire($time_expire);
        $input->SetGoods_tag($goods_tag);
        $input->SetNotify_url($notify_url);
        $input->SetTrade_type($trade_type);
        $input->SetProduct_id($product_id);
        $result = $notify->GetPayUrl($input);
        return $result;
    }
}
