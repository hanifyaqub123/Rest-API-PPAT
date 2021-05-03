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
    isset($data->bulan_ini) && 
    isset($data->nama_ppat) && 
    isset($data->jumlah_jual_beli) && 
    isset($data->total_luas_tanah_jual_beli) &&
    isset($data->total_nilai_jual_beli) &&
    isset($data->jumlah_tukar_menukar) &&
    isset($data->total_luas_tanah_tukar_menukar) &&
    isset($data->total_nilai_tukar_menukar) &&
    isset($data->jumlah_hibah) &&
    isset($data->total_luas_tanah_hibah) &&
    isset($data->total_nilai_hibah) &&
    isset($data->jumlah_aphb) &&
    isset($data->total_luas_tanah_aphb) &&
    isset($data->total_nilai_aphb) &&
    isset($data->jumlah_apht) &&
    isset($data->total_luas_tanah_apht) &&
    isset($data->total_nilai_apht) &&
    isset($data->total_nihil) &&
    isset($data->total_nilai) &&
    isset($data->total_ssp) &&
    isset($data->total_ssb) &&
    isset($data->tanggal_laporan) 




    
    ){
    // CHECK DATA VALUE IS EMPTY OR NOT
        
        $insert_query = "INSERT INTO `laporan_lengkap`(
            nik,
            bulan_ini,
            nama_ppat,
            jumlah_jual_beli,
            total_luas_tanah_jual_beli,
            total_nilai_jual_beli,
            jumlah_tukar_menukar,
            total_luas_tanah_tukar_menukar,
            total_nilai_tukar_menukar,
            jumlah_hibah,
            total_luas_tanah_hibah,
            total_nilai_hibah,
            jumlah_aphb,
            total_luas_tanah_aphb,
            total_nilai_aphb,
            jumlah_apht,
            total_luas_tanah_apht,
            total_nilai_apht,
            total_nihil,
            total_nilai,
            total_ssp,
            total_ssb,
            tanggal_laporan) 
        VALUES(
            :nik,
            :bulan_ini,
            :nama_ppat,
            :jumlah_jual_beli,
            :total_luas_tanah_jual_beli,
            :total_nilai_jual_beli,
            :jumlah_tukar_menukar,
            :total_luas_tanah_tukar_menukar,
            :total_nilai_tukar_menukar,
            :jumlah_hibah,
            :total_luas_tanah_hibah,
            :total_nilai_hibah,
            :jumlah_aphb,
            :total_luas_tanah_aphb,
            :total_nilai_aphb,
            :jumlah_apht,
            :total_luas_tanah_apht,
            :total_nilai_apht,
            :total_nihil,
            :total_nilai,
            :total_ssp,
            :total_ssb,
            :tanggal_laporan) ";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':nik', htmlspecialchars(strip_tags($data->nik)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':bulan_ini', htmlspecialchars(strip_tags($data->bulan_ini)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nama_ppat', htmlspecialchars(strip_tags($data->nama_ppat)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':jumlah_jual_beli', htmlspecialchars(strip_tags($data->jumlah_jual_beli)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_luas_tanah_jual_beli', htmlspecialchars(strip_tags($data->total_luas_tanah_jual_beli)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nilai_jual_beli', htmlspecialchars(strip_tags($data->total_nilai_jual_beli)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':jumlah_tukar_menukar', htmlspecialchars(strip_tags($data->jumlah_tukar_menukar)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_luas_tanah_tukar_menukar', htmlspecialchars(strip_tags($data->total_luas_tanah_tukar_menukar)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nilai_tukar_menukar', htmlspecialchars(strip_tags($data->total_nilai_tukar_menukar)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':jumlah_hibah', htmlspecialchars(strip_tags($data->jumlah_hibah)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_luas_tanah_hibah', htmlspecialchars(strip_tags($data->total_luas_tanah_hibah)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nilai_hibah', htmlspecialchars(strip_tags($data->total_nilai_hibah)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':jumlah_aphb', htmlspecialchars(strip_tags($data->jumlah_aphb)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_luas_tanah_aphb', htmlspecialchars(strip_tags($data->total_luas_tanah_aphb)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nilai_aphb', htmlspecialchars(strip_tags($data->total_nilai_aphb)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':jumlah_apht', htmlspecialchars(strip_tags($data->jumlah_apht)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_luas_tanah_apht', htmlspecialchars(strip_tags($data->total_luas_tanah_apht)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nilai_apht', htmlspecialchars(strip_tags($data->total_nilai_apht)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nihil', htmlspecialchars(strip_tags($data->total_nihil)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_nilai', htmlspecialchars(strip_tags($data->total_nilai)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_ssp', htmlspecialchars(strip_tags($data->total_ssp)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':total_ssb', htmlspecialchars(strip_tags($data->total_ssb)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':tanggal_laporan', htmlspecialchars(strip_tags($data->tanggal_laporan)),PDO::PARAM_STR);


        
        if($insert_stmt->execute()){
            $msg['message'] = "Berhasil Input";
        }else{
            $msg['message'] = 'Gagal Inserted';
        } 
}
else{
    $msg['message'] = 'Please fill all the fields';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>