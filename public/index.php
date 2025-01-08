<?php
    session_start();
    require_once '../vendor/autoload.php';

    use app\core\library\Session;
    use app\database\models\User;
    use app\database\Transaction;
   

    try {
        Session::set('name', 'Fedner');
        Session::flash('message', 'Welcome to my website');
       // Session::destroy('name');
        Session::dump();

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
    