<?php

namespace TmtPay\Storage;

use Illuminate\Database\Eloquent\Model;

class PayModel extends Model
{   
    /**
     * table name
     * @var string
     */
    protected $table = 'payorder';
}
