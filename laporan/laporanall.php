<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// INCLUDING DATABASE AND MAKING OBJECT
require 'database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

$post_id1 = $_GET['bulan_ini'];


// MAKE SQL QUERY
// IF GET POSTS ID, THEN SHOW POSTS BY ID OTHERWISE SHOW ALL POSTS
$sql = "SELECT * FROM `laporan_ppat` WHERE bulan_ini='$post_id1'"; 

$stmt = $conn->prepare($sql);

$stmt->execute();

//CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
if($stmt->rowCount() > 0){
    // CREATE POSTS ARRAY
    $posts_array = [];
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $post_data = [
            'id' => $row['id'],
            'nik' => $row['nik'],
            'akta_nomor' => $row['akta_nomor'],
            'akta_tanggal' => $row['akta_tanggal'],
            'bentuk_perbuatan_hukum' => $row['bentuk_perbuatan_hukum'],
            'nama_pengalihan' => $row['nama_pengalihan'],
            'nama_penerima' => $row['nama_penerima'],
            'jenis_dan_nomor_hak' => $row['jenis_dan_nomor_hak'],
            'letak_tanah_dan_bangunan' => $row['letak_tanah_dan_bangunan'],
            'luas_tanah' => $row['luas_tanah'],
            'luas_bangunan' => $row['luas_bangunan'],
            'nilai_transaksi' => $row['nilai_transaksi'],
            'nop_tahun' => $row['nop_tahun'],
            'njop_rp' => $row['njop_rp'],
            'ssp_tanggal' => $row['ssp_tanggal'],
            'ssp_rp' => $row['ssp_rp'],
            'ssb_tanggal' => $row['ssb_tanggal'],
            'ssb_rp' => $row['ssb_rp'],
            'ket' => $row['ket'],
            'bulan_ini' => $row['bulan_ini'],
            'nama_ppat' => $row['nama_ppat'],

            
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($posts_array, $post_data);
    }
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($posts_array);
 

}
else{
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode(['message'=>'No post found']);
}
?>



