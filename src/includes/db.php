<?php

declare(strict_types=1);
class Db
{


    private string $dns, $host, $dbname, $user, $pwd;

    private PDO|null $db;
    private bool $connected;



    public function __construct($host = 'db', $dbname = 'logindb', $user = 'root', $pwd = 'root')
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pwd = $pwd;
        $this->dns = "mysql:host=$this->host;dbname=$this->dbname";

        try {

            $this->db = new PDO($this->dns, $this->user, $this->pwd);

            $this->connected = true;
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }
    public function post($query, $params = [])
    {
        


        $this->stmt($query, $params);
      
        $this->destrucConnection();
    }

    public function get($query, $params = [], $single = true)
    {

        try {
            if ($single) {
                $result = $this->stmt($query, $params)->fetch(PDO::FETCH_ASSOC);
               
                return $result;
            }
            return $this->stmt($query, $params)->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $th) {
            $th->getMessage();
        }
    }

    public function destrucConnection()
    {

        $this->connected = false;
        $this->db = null;
    }
    private function stmt($query, $params = [])
    {




        if ($this->connected) {

            try {
                $stmt = $this->db->prepare($query);

                $stmt->execute($params);
                
                return $stmt;
            } catch (\PDOException $th) {
                echo $th->getMessage();
            }
        }
    }
}
