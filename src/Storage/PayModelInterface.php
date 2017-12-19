<?php

namespace TmtPay\Storage;

interface PayModelInterface
{
    /**
     * 创建订单
     * @return
     */
    public function CreateOrder($orderdata);

    /**
     * 修改支付方式
     * @return
     */
    public function ChangePayMethod($orderid, $method);

    /**
     * 修改订单状态
     * @return
     */
    public function ChangePayStatus($orderid, $status);

    /**
     * 校验支付状态
     * @return
     */
    public function CheckPayStatus($orderid);
}
