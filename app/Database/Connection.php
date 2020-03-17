<?php

namespace Course\Database;

use PDO;
use PDOException;

class Connection
{
    protected $db;

    public function __construct(array $data)
    {
        $tns = $this->getTNSName($data['host'], $data['port'], $data['database']);
        $user = $data['username'];
        $pass = $data['password'];
        $charset = $data['charset'];

        try {
            $this->db = new PDO('oci:dbname=' . $tns . ';charset=' . $charset, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection()
    {
        $GLOBALS['db'] = $this->db;
        return $this->db;
    }

    private function getTNSName(string $host, int $port, string $name)
    {
        return "(DESCRIPTION=
            (ADDRESS_LIST=
                (ADDRESS=
                    (PROTOCOL=TCP)
                    (HOST=" . $host . ")
                    (PORT=" . $port . ")
                )
            )
            (CONNECT_DATA=
                (SERVER=DEDICATED)
                (SERVICE_NAME=" . $name . ")
            )
        )";
    }
}
