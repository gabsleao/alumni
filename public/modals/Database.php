<?php

class Database extends PDO{
    private String $ServerName = "localhost";
    private String $Username = "root";
    private String $Password = "";
    private String $DatabaseName = "alumni";

    public function __construct(){
        try {
            parent::__construct("mysql:host=$this->ServerName;dbname=$this->DatabaseName", $this->Username, $this->Password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $this;
          } catch(PDOException $Exception) {
            echo "Connection failed: " . $Exception->getMessage();
          }
    }
}