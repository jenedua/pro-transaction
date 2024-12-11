<?php
    require_once '../vendor/autoload.php';

use app\database\models\User;
use app\database\Transaction;
   

    try {

        Transaction::open();
        $user = new User();
        $user->id = 7;
        //$user->name = 'Jenasha';
       // $user->email = 'fedner31@example.com';
        //$user->password = password_hash('123456', PASSWORD_DEFAULT);
        echo "<pre>";
        //$user = $user->getById('*');
        $user = $user->all('*');
        var_dump($user);
        //print_r($user->getData());


        // $post =new Post();
        // $post->update(1);

        Transaction::close();

    } catch (\Throwable $th) {
       //var_dump($th->getMessage());
       var_dump($th->getTrace());
        Transaction::rollback();
    }
    