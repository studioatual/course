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
    protected $params;

    public function __construct()
    {
        $this->primaryKey = 'id';
        $this->db = $GLOBALS['db'];
    }

    public function create($params)
    {
        $this->params = $this->filterParams($params);
        $sql  = "INSERT INTO " . $this->table . " (";
        $sql .= $this->primaryKey;
        foreach ($this->params as $key => $value) {
            $sql .= ',' . $key;
        }
        $sql .= ",created_at";
        $sql .= ") VALUES (";
        $sql .= "(SELECT NVL(MAX(" . $this->primaryKey . "), 0)+1 FROM " . $this->table . ")";
        foreach ($this->params as $key => $value) {
            $sql .= ',:' . $key;
        }
        $sql .= ", LOCALTIMESTAMP";
        $sql .= ")";
        $result = $this->db->prepare($sql);
        $result->execute($this->params);
        //$this->params['id'] = $this->db->lastInsertId();
    }

    public function update($params)
    {
        $this->params = $this->filterParams($params);
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

    public function first($value)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = :" . $this->primaryKey;
        $query = $this->db->prepare($sql);
        $query->execute([
            $this->primaryKey => $value
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    private function filterParams($params)
    {
        $arr = [];
        foreach ($params as $key => $value) {
            if (count(array_values(array_filter($this->fillable, function ($field) use ($key) {
                if ($field == $key) {
                    return $field;
                }
            })))) {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    public function __set($key, $value)
    {
        foreach ($this->fillable as $field) {
            if ($field == $key) {
                $this->params[$key] = $value;
            }
        }
    }

    public function __get($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
    }
}
