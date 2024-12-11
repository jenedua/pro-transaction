<?php
    namespace app\database\models;
    use app\database\ActiveRecord;
    use app\database\Transaction;

    class User extends ActiveRecord{
        const TABLE_NAME = 'users';
        public function getUsers(){
            $conn =Transaction::get();
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function delete($id){
            $conn =Transaction::get();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }
    }