<?php
 class Database {
    private $localhost = 'localhost';
    private $root = 'root';
    private $pass = '';
    private $dbname = 'a_database';

    private $con = '';
    private $con_sta = false;

    function __construct(){
        if(!$this->con_sta){
            $this->con = new mysqli($this->localhost, $this->root, $this->pass, $this->dbname);
            if($this->con->connect_error){
                $this->con_sta = false;
            }else{
                $this->con_sta = true;
            }
        }
    }

    public function insert_data($table, $arr){
        $this->pr($arr);
          $cols = implode(', ', array_keys($arr));
          $vals = "'".implode("', '", $arr)."'";
          $que = "INSERT INTO $table($cols) VALUES($vals)";
         $this->con->query(($que));
         if($this->con->affected_rows > 0){
            return true;
         }else{
            return false;
         }


    }
    public function select_data($table, $condition=array()){
        $finial_condition = $this->get_arr($condition, true);
        if(empty($condition)){
            $sql = "SELECT * FROM $table";
        }else{
            $sql = "SELECT * FROM $table WHERE $finial_condition";
        }
        
        $result = $this->con->query($sql);
        $arr = array();
        while($row = $result->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;

    }
    public function update_data($table, $arr, $condition){
       $final_string = $this->get_arr($arr);
       $final_condition =$this->get_arr($condition, true);
        $que = "UPDATE $table SET $final_string WHERE $final_condition";
        $this->con->query($que);
        if($this->con->affected_rows > 0){
            return true;
         }else{
            return false;
         }

    }
    public function delete_data($table, $condition){
        $finial_condition = $this->get_arr($condition, true);
        $sql = "DELETE FROM  $table WHERE $finial_condition";
        $this->con->query($sql);
        if($this->con->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    private function get_arr($arr, $condition=false){
        $final_string = '';
        $c = count($arr);
        $i = 1;
        foreach($arr as $k=>$v){
            if($i == $c){
                $final_string .= $k."="."'".$v."' ";
            }else{
                if(!$condition){
                    $final_string .= $k."="."'".$v."', ";
                }else{
                    $final_string .= $k."="."'".$v."' AND ";
                }
                
            }
            $i++;  
        }
        return $final_string;
    }

    public function pr($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    public function safe_str($str){
        return mysqli_real_escape_string($this->con,$str);
    }
 }
?>