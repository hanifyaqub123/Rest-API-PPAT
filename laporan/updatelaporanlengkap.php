<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require 'database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));

//CHECKING, IF ID AVAILABLE ON $data
if(isset($data->id)){
    
    $msg['message'] = '';
    $post_id = $data->id;
    
    //GET POST BY ID FROM DATABASE
    $get_post = "SELECT * FROM `laporan_lengkap` WHERE id=:post_id";
    $get_stmt = $conn->prepare($get_post);
    $get_stmt->bindValue(':post_id', $post_id,PDO::PARAM_INT);
    $get_stmt->execute();
    
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($get_stmt->rowCount() > 0){
        
        // FETCH POST FROM DATBASE 
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
        
        
        // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
        $postnik = isset($data->nik) ? $data->nik : $row['nik'];
        $postbulan_ini = isset($data->bulan_ini) ? $data->bulan_ini : $row['bulan_ini'];
        $postnama_ppat = isset($data->nama_ppat) ? $data->nama_ppat : $row['nama_ppat'];
        $postjumlah_jual_beli = isset($data->jumlah_jual_beli) ? $data->jumlah_jual_beli : $row['jumlah_jual_beli'];
        $posttotal_luas_tanah_jual_beli = isset($data->total_luas_tanah_jual_beli) ? $data->total_luas_tanah_jual_beli : $row['total_luas_tanah_jual_beli'];
        $posttotal_nilai_jual_beli = isset($data->total_nilai_jual_beli) ? $data->total_nilai_jual_beli : $row['total_nilai_jual_beli'];
        $postjumlah_tukar_menukar = isset($data->jumlah_tukar_menukar) ? $data->jumlah_tukar_menukar : $row['jumlah_tukar_menukar'];
        $posttotal_luas_tanah_tukar_menukar = isset($data->total_luas_tanah_tukar_menukar) ? $data->total_luas_tanah_tukar_menukar : $row['total_luas_tanah_tukar_menukar'];
        $posttotal_nilai_tukar_menukar = isset($data->total_nilai_tukar_menukar) ? $data->total_nilai_tukar_menukar : $row['total_nilai_tukar_menukar'];
        $postjumlah_hibah = isset($data->jumlah_hibah) ? $data->jumlah_hibah : $row['jumlah_hibah'];
        $posttotal_luas_tanah_hibah = isset($data->total_luas_tanah_hibah) ? $data->total_luas_tanah_hibah : $row['total_luas_tanah_hibah'];
        $posttotal_nilai_hibah = isset($data->total_nilai_hibah) ? $data->total_nilai_hibah : $row['total_nilai_hibah'];
        $postjumlah_aphb = isset($data->jumlah_aphb) ? $data->jumlah_aphb : $row['jumlah_aphb'];
        $posttotal_luas_tanah_aphb = isset($data->total_luas_tanah_aphb) ? $data->total_luas_tanah_aphb : $row['total_luas_tanah_aphb'];
        $posttotal_nilai_aphb = isset($data->total_nilai_aphb) ? $data->total_nilai_aphb : $row['total_nilai_aphb'];
        $postjumlah_apht = isset($data->jumlah_apht) ? $data->jumlah_apht : $row['jumlah_apht'];
        $posttotal_luas_tanah_apht = isset($data->total_luas_tanah_apht) ? $data->total_luas_tanah_apht : $row['total_luas_tanah_apht'];
        $posttotal_nilai_apht = isset($data->total_nilai_apht) ? $data->total_nilai_apht : $row['total_nilai_apht'];
        $posttotal_nihil = isset($data->total_nihil) ? $data->total_nihil : $row['total_nihil'];
        $posttotal_nilai = isset($data->total_nilai) ? $data->total_nilai : $row['total_nilai'];
        $posttotal_ssp = isset($data->total_ssp) ? $data->total_ssp : $row['total_ssp'];
        $posttotal_ssb = isset($data->total_ssb) ? $data->total_ssb : $row['total_ssb'];
        $posttanggal_laporan = isset($data->tanggal_laporan) ? $data->tanggal_laporan : $row['tanggal_laporan'];


        
        
        $update_query = "UPDATE `laporan_lengkap` SET 
            nik = :nik,
            bulan_ini = :bulan_ini,
            nama_ppat = :nama_ppat,
            jumlah_jual_beli = :jumlah_jual_beli,
            total_luas_tanah_jual_beli = :total_luas_tanah_jual_beli,
            total_nilai_jual_beli = :total_nilai_jual_beli,
            jumlah_tukar_menukar = :jumlah_tukar_menukar,
            total_luas_tanah_tukar_menukar = :total_luas_tanah_tukar_menukar,
            total_nilai_tukar_menukar = :total_nilai_tukar_menukar,
            jumlah_hibah = :jumlah_hibah,
            total_luas_tanah_hibah = :total_luas_tanah_hibah,
            total_nilai_hibah = :total_nilai_hibah,
            jumlah_aphb = :jumlah_aphb,
            total_luas_tanah_aphb = :total_luas_tanah_aphb,
            total_nilai_aphb = :total_nilai_aphb,
            jumlah_apht = :jumlah_apht,
            total_luas_tanah_apht = :total_luas_tanah_apht,
            total_nilai_apht = :total_nilai_apht,
            total_nihil = :total_nihil,
            total_nilai = :total_nilai,
            total_ssp = :total_ssp,
            total_ssb = :total_ssb,
            tanggal_laporan	 = :tanggal_laporan	
   
        WHERE id = :id";
        
        $update_stmt = $conn->prepare($update_query);
        
        // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS
        $update_stmt->bindValue(':nik', htmlspecialchars(strip_tags($postnik)),PDO::PARAM_STR);
        $update_stmt->bindValue(':bulan_ini', htmlspecialchars(strip_tags($postbulan_ini)),PDO::PARAM_STR);
        $update_stmt->bindValue(':nama_ppat', htmlspecialchars(strip_tags($postnama_ppat)),PDO::PARAM_STR);
        $update_stmt->bindValue(':jumlah_jual_beli', htmlspecialchars(strip_tags($postjumlah_jual_beli)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_luas_tanah_jual_beli', htmlspecialchars(strip_tags($posttotal_luas_tanah_jual_beli)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nilai_jual_beli', htmlspecialchars(strip_tags($posttotal_nilai_jual_beli)),PDO::PARAM_STR);
        $update_stmt->bindValue(':jumlah_tukar_menukar', htmlspecialchars(strip_tags($postjumlah_tukar_menukar)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_luas_tanah_tukar_menukar', htmlspecialchars(strip_tags($posttotal_luas_tanah_tukar_menukar)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nilai_tukar_menukar', htmlspecialchars(strip_tags($posttotal_nilai_tukar_menukar)),PDO::PARAM_STR);
        $update_stmt->bindValue(':jumlah_hibah', htmlspecialchars(strip_tags($postjumlah_hibah)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_luas_tanah_hibah', htmlspecialchars(strip_tags($posttotal_luas_tanah_hibah)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nilai_hibah', htmlspecialchars(strip_tags($posttotal_nilai_hibah)),PDO::PARAM_STR);
        $update_stmt->bindValue(':jumlah_aphb', htmlspecialchars(strip_tags($postjumlah_aphb)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_luas_tanah_aphb', htmlspecialchars(strip_tags($posttotal_luas_tanah_aphb)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nilai_aphb', htmlspecialchars(strip_tags($posttotal_nilai_aphb)),PDO::PARAM_STR);
        $update_stmt->bindValue(':jumlah_apht', htmlspecialchars(strip_tags($postjumlah_apht)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_luas_tanah_apht', htmlspecialchars(strip_tags($posttotal_luas_tanah_apht)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nilai_apht', htmlspecialchars(strip_tags($posttotal_nilai_apht)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nihil', htmlspecialchars(strip_tags($posttotal_nihil)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_nilai', htmlspecialchars(strip_tags($posttotal_nilai)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_ssp', htmlspecialchars(strip_tags($posttotal_ssp)),PDO::PARAM_STR);
        $update_stmt->bindValue(':total_ssb', htmlspecialchars(strip_tags($posttotal_ssb)),PDO::PARAM_STR);
        $update_stmt->bindValue(':tanggal_laporan', htmlspecialchars(strip_tags($posttanggal_laporan)),PDO::PARAM_STR);
   

        $update_stmt->bindValue(':id', $post_id,PDO::PARAM_INT);
        
        
        if($update_stmt->execute()){
            $msg['message'] = "Berhasil Update";
        }else{
            $msg['message'] = 'Gagal  Updated';
        }   
        
    }
    else{
        $msg['message'] = 'Invlid ID';
    }  
    
    echo  json_encode($msg);
    
}
?>