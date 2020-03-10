<?php

class EmailConfig {

    public $gmail = array(
        
        'from' => array('email@gmail.com' => 'MBC MicroBlog Chaste'),
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'clsu.procurement.service@gmail.com',
        'password' => '123456Admins',
        'transport' => 'Smtp',
        'cc' => 'macayananjoselin@gmail.com',
        'bcc' => 'macayananjoselin@gmail.com',
        'client' => null,
        'log' => true,
        'context' => [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]
    );

}
