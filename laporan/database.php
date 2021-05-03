<?php
class Database{
    
    // private $db_host = 'localhost';
    // private $db_name = 'ppat';
    // private $db_username = 'u1423116_bpn';
    // private $db_password = 'Cyber123Cyber123@@@';
    private $db_host = 'localhost';
    private $db_name = 'ppat';
    private $db_username = 'root';
    private $db_password = 'Cyber123';
    
    
    public function dbConnection(){
        
        try{
            $conn = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
        
        
    }
}
?>