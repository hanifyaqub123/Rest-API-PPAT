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
    isset($data->akta_nomor) && 
    isset($data->akta_tanggal) && 
    isset($data->bentuk_perbuatan_hukum) && 
    isset($data->nama_pengalihan) && 
    isset($data->nama_penerima) &&
    isset($data->jenis_dan_nomor_hak) &&
    isset($data->letak_tanah_dan_bangunan) &&
    isset($data->luas_tanah) &&
    isset($data->luas_bangunan) &&
    isset($data->nilai_transaksi) &&
    isset($data->nop_tahun) &&
    isset($data->njop_rp) &&
    isset($data->ssp_tanggal) &&
    isset($data->ssp_rp) &&
    isset($data->ssb_tanggal) &&
    isset($data->ssb_rp) &&
    isset($data->ket) &&
    isset($data->bulan_ini) &&
    isset($data->nama_ppat) 

    
    ){
    // CHECK DATA VALUE IS EMPTY OR NOT
        
        $insert_query = "INSERT INTO `laporan_ppat`(
            nik,
            akta_nomor,
            akta_tanggal,
            bentuk_perbuatan_hukum,
            nama_pengalihan,
            nama_penerima,
            jenis_dan_nomor_hak,
            letak_tanah_dan_bangunan,
            luas_tanah,
            luas_bangunan,
            nilai_transaksi,
            nop_tahun,
            njop_rp,
            ssp_tanggal,
            ssp_rp,
            ssb_tanggal,
            ssb_rp,
            ket,
            bulan_ini,
            nama_ppat) 
        VALUES(
            :nik,
            :akta_nomor,
            :akta_tanggal,
            :bentuk_perbuatan_hukum,
            :nama_pengalihan,
            :nama_penerima,
            :jenis_dan_nomor_hak,
            :letak_tanah_dan_bangunan,
            :luas_tanah,
            :luas_bangunan,
            :nilai_transaksi,
            :nop_tahun,
            :njop_rp,
            :ssp_tanggal,
            :ssp_rp,
            :ssb_tanggal,
            :ssb_rp,
            :ket,
            :bulan_ini,
            :nama_ppat)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':nik', htmlspecialchars(strip_tags($data->nik)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':akta_nomor', htmlspecialchars(strip_tags($data->akta_nomor)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':akta_tanggal', htmlspecialchars(strip_tags($data->akta_tanggal)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':bentuk_perbuatan_hukum', htmlspecialchars(strip_tags($data->bentuk_perbuatan_hukum)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nama_pengalihan', htmlspecialchars(strip_tags($data->nama_pengalihan)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nama_penerima', htmlspecialchars(strip_tags($data->nama_penerima)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':jenis_dan_nomor_hak', htmlspecialchars(strip_tags($data->jenis_dan_nomor_hak)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':letak_tanah_dan_bangunan', htmlspecialchars(strip_tags($data->letak_tanah_dan_bangunan)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':luas_tanah', htmlspecialchars(strip_tags($data->luas_tanah)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':luas_bangunan', htmlspecialchars(strip_tags($data->luas_bangunan)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nilai_transaksi', htmlspecialchars(strip_tags($data->nilai_transaksi)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nop_tahun', htmlspecialchars(strip_tags($data->nop_tahun)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':njop_rp', htmlspecialchars(strip_tags($data->njop_rp)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':ssp_tanggal', htmlspecialchars(strip_tags($data->ssp_tanggal)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':ssp_rp', htmlspecialchars(strip_tags($data->ssp_rp)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':ssb_tanggal', htmlspecialchars(strip_tags($data->ssb_tanggal)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':ssb_rp', htmlspecialchars(strip_tags($data->ssb_rp)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':ket', htmlspecialchars(strip_tags($data->ket)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':bulan_ini', htmlspecialchars(strip_tags($data->bulan_ini)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nama_ppat', htmlspecialchars(strip_tags($data->nama_ppat)),PDO::PARAM_STR);


        
        if($insert_stmt->execute()){
            $msg['message'] = "Pengisian Berhasil !";
        }else{
            $msg['message'] = 'Pengisian Gagal !';
        } 
}
else{
    $msg['message'] = 'Please fill all the fields';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>