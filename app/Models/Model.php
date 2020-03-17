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
        $params = $this->filterParams($params);
        $sql  = "INSERT INTO " . $this->table . " (";
        $sql .= $this->primaryKey;
        foreach ($params as $key => $value) {
            $sql .= ',' . $key;
        }
        $sql .= ") VALUES (";
        $sql .= "(SELECT NVL(MAX(" . $this->primaryKey . "), 0)+1 FROM " . $this->table . ")";
        foreach ($params as $key => $value) {
            $sql .= ',' . $value;
        }
        $sql .= ")";
        $this->db->query($sql);
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

    private function filterParams($params)
    {
        $arr = [];
        foreach ($params as $key => $value) {
            if (array_filter($this->fillable, function ($field) use ($key) {
                if ($field == $key) {
                    return $field;
                }
            })) {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }
}
