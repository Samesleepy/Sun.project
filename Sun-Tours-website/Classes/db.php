<?php
class Database
{   
    private $host = "localhost";
    private $dbname = "sunproject";
    private $username = "root";
    private $password = "";

    public $conn;

    public function connection(){
        $this->conn = NULL;

        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection error:".$e->getMessage();
        }
        
        return $this->conn;
    }

    public function Encrypt($text,$key){
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptje = openssl_encrypt($text, 'aes-256-cbc', $encryption_key, 0, $iv);
        $result = base64_encode($encryptje . '::' . $iv);
        return $result;
    }

    public function Decrypt($txet,$key){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = explode('::', base64_decode($txet), 2);
        $result = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return $result;
    }
}