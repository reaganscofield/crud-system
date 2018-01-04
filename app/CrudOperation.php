<?php

    //bring database file to extends
    //it Class if main class
    include("./db/db.php");

//MAIN CLASS FOR THE APP EXTENDS WITH DATABASE CLASS
  class CrudOperation extends Database {

        //method  to save new message to database
        public function insertRecord($table, $fields){
            $sql = "INSERT INTO " . $table. "(".implode(",", array_keys($fields)).") VALUES
                                ('".implode("','", array_values($fields))."')";
            $query = mysqli_query($this->dbConnection, $sql);
            if($query){
              return true;
            }
        }


        //method to fetch all message from database
        public function fetchRecord($table){
          $selectTable = "SELECT * FROM " .$table;
          $array = array();
          $runQuery = mysqli_query($this->dbConnection, $selectTable);
          while($fetchRow =  mysqli_fetch_assoc($runQuery)){
            $array[] = $fetchRow;
          }
          return $array;
        }


        //method to delete message from database an ui
        public function deleteRecord($table, $where){
          $sql = "";
          $thisCondition = "";
          $message = "";
          foreach($where as $key => $value){
            $thisCondition .= $key . "= ' " .$value. " ' AND ";
          }
          $thisCondition = substr($thisCondition, 0, - 5);
          $sqlDelete = "DELETE FROM " .$table. " WHERE " .$thisCondition;
          $runQuery = mysqli_query($this->dbConnection, $sqlDelete);
            if($runQuery){
              $message .= "You Have Deleted";
              return true;
            }
        }


        //method to get single message from database
        public function selectSingleRecord($table, $where){
            $selectSingle  = "";
            $setDefault = "";
            foreach($where as $key => $value){
              $setDefault .= $key . " = ' " .$value. "' AND ";
            }
            $setDefault = substr($setDefault, 0, -5);
            $selectSingle .= "SELECT * FROM " .$table. " WHERE " . $setDefault;
            $runQuery = mysqli_query($this->dbConnection, $selectSingle);
            $fetchRow = mysqli_fetch_array($runQuery);
            // if(!$fetchRow){
            //   echo ("Error with selecting" .mysqli_error($this->dbConnection));
            // }
          return $fetchRow;
      }


        //method to update
        public function updateRecord($table, $where, $fields){
            $sql = "";
            $thisCondition = "";
            foreach($where as $key => $value){
              $thisCondition .= $key . "='" . $value . "' AND ";
            }
            $thisCondition .= substr($thisCondition, 0, -5);
            foreach($fields as $key => $value){
              $sql .= $key . "='".$value."' ";  //if you user multifield include "," after the single quote
            }
            $slq = substr($sql, 0, -2);
            $sql = "UPDATE " .$table." SET " .$sql." WHERE " . $thisCondition;
            $runQuery = mysqli_query($this->dbConnection, $sql);
                // if(!$runQuery){
                //   echo ("Error with selecting" .mysqli_error($this->dbConnection));
                // }
              if($runQuery){
                return true;
              }
        }

}


//seeting Class of an Objects to the
//new variable names Objects
$Objects = new CrudOperation;




//getting use message from input fields
//creating new message and save it
//to the database with an objects
$thisMessage = "";
$thisMessage = null;
if(isset($_POST['submit'])){
    if(empty($_POST['message'])){
      $thisMessage .=   '<div class="alert alert-danger">Please Enter Your Message</div>';
    } else {
          $inputArray = array(
          "message" => $_POST["message"],
          );
            if($Objects->insertRecord("crud", $inputArray)){
            header("Location: index.php");
          }
    }
}



//getting id and seeting to an array
//delete message with ojects
$successMesage = "";
$successMesage = null;
  if(isset($_GET['Delete'])){
    $getID = $_GET['Delete'];
    $where = array("id" => $getID);
    if($Objects->deleteRecord("crud", $where)){
      $successMesage .= '<div class="alert alert-success">You Have Deleted Message</div>';
      header("Location: index.php");
    }
  }


//gitting message input and setting it to an
//array and updated messege with an Objects
  if(isset($_POST['update'])){
    $thisID = $_POST['id'];
    $where = array("id" => $thisID);
    $myArray = array(
      'message' => $_POST['message']
    );
    if($Objects->updateRecord("crud", $where, $myArray)){
      header("Location: index.php");
    }
  }

?>
