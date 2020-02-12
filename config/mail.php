<?php
return [
    "driver" => env("MAIL_DRIVER", ""),
    "host" => env("MAIL_HOST", ""),
    "port" => 2525,
    "from" => array(
        "address" => env("MAIL_FROM_ADDRESS", 'laravel'),
        "name" => env("MAIL_FROM_NAME", 'laravel'),
    ),
    "username" => env("MAIL_USERNAME", ''),
    "password" => env("MAIL_PASSWORD", ''),
    "sendmail" => "/usr/sbin/sendmail -bs"
];
