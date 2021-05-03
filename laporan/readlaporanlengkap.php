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

$post_id = $_GET['nik'];
$post_id1 = $_GET['bulan_ini'];


// MAKE SQL QUERY
// IF GET POSTS ID, THEN SHOW POSTS BY ID OTHERWISE SHOW ALL POSTS
$sql = "SELECT * FROM `laporan_lengkap` WHERE nik='$post_id' AND bulan_ini='$post_id1'"; 

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
            'bulan_ini' => $row['bulan_ini'],
            'nama_ppat' => $row['nama_ppat'],
            'jumlah_jual_beli' => $row['jumlah_jual_beli'],
            'total_luas_tanah_jual_beli' => $row['total_luas_tanah_jual_beli'],
            'total_nilai_jual_beli' => $row['total_nilai_jual_beli'],
            'jumlah_tukar_menukar' => $row['jumlah_tukar_menukar'],
            'total_luas_tanah_tukar_menukar' => $row['total_luas_tanah_tukar_menukar'],
            'total_nilai_tukar_menukar' => $row['total_nilai_tukar_menukar'],
            'jumlah_hibah' => $row['jumlah_hibah'],
            'total_luas_tanah_hibah' => $row['total_luas_tanah_hibah'],
            'total_nilai_hibah' => $row['total_nilai_hibah'],
            'jumlah_aphb' => $row['jumlah_aphb'],
            'total_luas_tanah_aphb' => $row['total_luas_tanah_aphb'],
            'total_nilai_aphb' => $row['total_nilai_aphb'],
            'jumlah_apht' => $row['jumlah_apht'],
            'total_luas_tanah_apht' => $row['total_luas_tanah_apht'],
            'total_nilai_apht' => $row['total_nilai_apht'],
            'total_nilai' => $row['total_nilai'],
            'total_ssp' => $row['total_ssp'],
            'total_ssb' => $row['total_ssb']

            
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



