<?php
    namespace app\database;

    use app\database\Transaction ;
use PDO;

    abstract class ActiveRecordActions{
        private function insert($tableName){
            $conn = Transaction::get();
            //var_dump(static::TABLE_NAME);
            $sql = "INSERT INTO {$tableName}(".implode(',', array_keys($this->data)).") VALUES 
            (:".implode(',:', array_keys($this->data)).")";

            
            $prepare = $conn->prepare($sql);
           return $prepare->execute($this->data);

        }
        private function update($tableName){
            $conn = Transaction::get();
            $sql = " UPDATE {$tableName} set";
                foreach (array_keys($this->data) as $key) {
                    if ($key != 'id') {
                        $sql .= " {$key} = :{$key},";
                    }
                }
                $sql = rtrim($sql, ',');
                $sql .= " WHERE id = :id";
                $prepare = $conn->prepare($sql);
                return $prepare->execute($this->data);
            
        }
        public function save(){
            $class = get_class($this);//pega o nome da classe que está sendo instanciada
            $tableName = constant("{$class}::TABLE_NAME");//pega o valor da constante

            return array_key_exists('id', $this->data) ? $this->update($tableName) : $this->insert($tableName); 

        }

        public function getById(string $fields = '*', ?int $id = null){

            $class = get_class($this);//pega o nome da classe que está sendo instanciada
            $tableName = constant("{$class}::TABLE_NAME");//pega o valor da constante
            if(array_key_exists('id', $this->data)){
                $id = $this->data['id'];
            }
            $sql = "SELECT {$fields} FROM {$tableName} WHERE id = :id";
            $conn = Transaction::get();

            $prepare = $conn->prepare($sql);
             $prepare->execute([
                'id' => $id
            ]);
            return $prepare->fetchObject($class);
        }

        public function all(string $fields = '*'){
            $class = get_class($this);//pega o nome da classe que está sendo instanciada
            $tableName = constant("{$class}::TABLE_NAME");//pega o valor da constante
            $sql = "SELECT {$fields} FROM {$tableName}";
            $conn = Transaction::get();
            $prepare = $conn->prepare($sql);
            $prepare->execute();
            return $prepare->fetchAll(PDO::FETCH_CLASS, $class);
            
        }

    }