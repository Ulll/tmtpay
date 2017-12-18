<?php

/**
 * 该查询类默认使用eloquent orm, 如果需要更换其他orm，可以重写该类,只要阶层PayModelInterface即可
 */

namespace TmtPay\Storage;

use TmtPay\Storage\PayModelInterface;
use TmtPay\Storage\Eloquent\PayorderModel;

class PayModel implements PayModelInterface
{   
    /**
     * 创建订单
     * @return
     */
    public function CreateOrder()
    {

    }

    /**
     * 修改支付方式
     * @return
     */
    public function ChangePayMethod()
    {

    }

    /**
     * 修改订单状态
     * @return
     */
    public function ChangePayStatus()
    {

    }

    /**
     * 校验支付状态
     * @return
     */
    public function CheckPayStatus()
    {

    }
}
