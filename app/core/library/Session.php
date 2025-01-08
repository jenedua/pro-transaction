<?php
    namespace app\core\library;
     class Session{
        // public function __construct(){
        //     session_start();
        // }
        public static function set($key, $value){
            $_SESSION[$key] = $value;
        }
        public static function dump(){
            var_dump($_SESSION);
            die();
        }

        public static function has(string $index){
            return isset($_SESSION[$index]);
        }
        public static function delete(string $index){
            if(self::has($index)){
                unset($_SESSION[$index]);
            }
        }
        public static function destroy(){
            session_destroy();
        }
        public static function flash(string $index, mixed $value){
            $_SESSION['__flash'][$index] = $value;
        }
        public static function get(string $index){
            if(self::has($index)){
                return $_SESSION[$index];
            }
        }


     }