<?php 

namespace Tmtpay;

use Tmtpay\Storage\PayModel;

class Pay
{   
    public $payModel;

    /**
     * 支付时必需的初始化参数
     */
    public function __construct(PayModel $payModel)
    {
        $this->payModel = $payModel;
    }

    /**
     * 生成订单ID
     * @return
     */
    public function GenerateOrderId()
    {
        
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
        
    }
}
