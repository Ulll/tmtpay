<?php

namespace TmtPay\Storage;

use Illuminate\Database\Capsule\Manager as Capsule;

$cfg = [

  'driver'    => 'mysql',

  'host'      => 'localhost',

  'database'  => 'payment',

  'username'  => 'root',

  'password'  => 'password',

  'charset'   => 'utf8',

  'collation' => 'utf8_general_ci',

  'prefix'    => ''

];

// Eloquent ORM
$capsule = new Capsule;

$capsule->addConnection($cfg);

$capsule->bootEloquent();