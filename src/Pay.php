<?php 

namespace Tmtpay;

use TmtPay\Storage\PayModelInterface;
use TmtPay\Exception\TmtException;

class Pay
{   
    public $payModel;

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
        $supprotPayMethod = [
            'weixin', //微信扫码支付
            'weixin_jsapi', //微信浏览器内支付
            'weixin_app', //第三方应用内微信支付
            'alipay', //支付宝扫码支付
            'alipay_wap', //支付宝wap端支付
            'alipay_app', //第三方引用内支付宝支付
        ];
        if (!in_array($payMethod, $supprotPayMethod)) {
            throw new TmtException("error:10010", "not supprot payMethod", 406);
        }
        return true;
    }


    public function GetProofByMethod($orderData, $payMethod)
    {
        switch ($payMethod) {
            case 'weixin':
                
                break;
            case 'alipay':

                break;
            default:
                throw new TmtException("error:10010", "not supprot payMethod", 406);
                break;
        }
    }
}
