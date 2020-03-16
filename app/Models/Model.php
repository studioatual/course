<?php

namespace Course\Models;

class Model
{
    protected $table;
    protected $fillable;
    protected $primaryKey;
    protected $hidden;
    protected $cast;
    protected $db;


    public function __construct($container)
    {
        $this->primaryKey = 'id';
        $this->db = $container->get('db');
    }

    public function create($params)
    {
        
    }

    public function update($params)
    {

    }

    public function delete()
    {
        
    }

    public function get()
    {

    }

    public function all()
    {

    }

    public function first()
    {
        
    }
}