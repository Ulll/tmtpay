<?php

namespace TmtPay;


interface PayInterface
{
    /**
     * 创建订单
     * @return
     */
    public function CreateOrder();

    /**
     * 修改支付方式
     * @return
     */
    public function ChangePayMethod();

    /**
     * 修改订单状态
     * @return
     */
    public function ChangePayStatus();

    /**
     * 校验支付状态
     * @return
     */
    public function CheckPayStatus();
}
