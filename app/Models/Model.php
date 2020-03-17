<?php

namespace Course\Models;

use PDO;

class Model
{
    protected $table;
    protected $fillable;
    protected $primaryKey;
    protected $hidden;
    protected $cast;
    protected $db;

    public function __construct()
    {
        $this->primaryKey = 'id';
        $this->db = $GLOBALS['db'];
    }

    public function create($params)
    {
    }

    public function update($params)
    {
    }

    public function delete($key)
    {
    }

    public function get()
    {
    }

    public function all()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function first()
    {

    }
}
