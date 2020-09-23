<?php

namespace App;

use PDO;

class Connect {

    private $dbConnect;
    private $isConn;

    public function __construct(string $host = 'localhost', string $user ='root', string $pass ='', string $dbName = 'ajax_php'){

        $dsn = 'mysql:dbname='. $dbName.';host='.$host;
        
        $this->isConn = TRUE;
        try {
            $this->dbConnect = new PDO($dsn, $user, $pass);
            $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->dbConnect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage() );
        }
    }

    public function getDbConnect()
    {
        return $this->dbConnect;
    }


}