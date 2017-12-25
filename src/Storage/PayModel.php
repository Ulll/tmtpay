<?php

/**
 * 该查询类默认使用eloquent orm, 如果需要更换其他orm，可以重写该类,只要阶层PayModelInterface即可
 */

namespace TmtPay\Storage;

use TmtPay\Storage\PayModelInterface;
use TmtPay\Storage\Eloquent\PayorderModel;
use TmtPay\Exception\TmtException;

class PayModel implements PayModelInterface
{   
    /**
     * 创建订单
     * @return
     */
    public function CreateOrder($orderdata)
    {
        $paydb = new PayorderModel;
        foreach ($orderdata as $k=>$v) {
            $paydb->{$k} = $v;
        }
        return $paydb->save();
    }

    /**
     * 修改支付方式
     * @return
     */
    public function ChangePayMethod($orderid, $method)
    {

    }

    /**
     * 修改订单状态
     * @return
     */
    public function ChangePayStatus($orderid, $status)
    {

    }

    /**
     * 校验支付状态
     * @return
     */
    public function CheckPayStatus($orderid)
    {

    }

    /**
     * 通过订单ID获取订单详情
     * @param  integer $orderid
     * @return array
     */
    public function getOrderDataById($orderid)
    {
        return PayorderModel::where('order_id', '=', $orderid)->firstOrFail();
    }
}
