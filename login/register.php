<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require 'database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));

//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if(
    isset($data->nik) && 
    isset($data->nama_lengkap) && 
    isset($data->alamat) && 
    isset($data->email) && 
    isset($data->password) && 
    isset($data->img) 
    
    ){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if( 
        !empty($data->nik) && 
        !empty($data->nama_lengkap) && 
        !empty($data->alamat)&&
        !empty($data->email) && 
        !empty($data->password) && 
        !empty($data->img) 

        
        ){
        
        $insert_query = "INSERT INTO `user_ppat`(
            nik,
            nama_lengkap,
            alamat,
            email,
            password,
            img) 
        VALUES(
            :nik,
            :nama_lengkap,
            :alamat,
            :email,
            :password,
            :img)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':nik', htmlspecialchars(strip_tags($data->nik)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nama_lengkap', htmlspecialchars(strip_tags($data->nama_lengkap)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':alamat', htmlspecialchars(strip_tags($data->alamat)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':email', htmlspecialchars(strip_tags($data->email)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':password', htmlspecialchars(strip_tags($data->password)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':img', htmlspecialchars(strip_tags($data->img)),PDO::PARAM_STR);


        
        if($insert_stmt->execute()){
            $msg['message'] = $data;
        }else{
            $msg['message'] = 'Data not Inserted';
        } 
        
    }else{
        $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    }
}
else{
    $msg['message'] = 'Please fill all the fields';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>