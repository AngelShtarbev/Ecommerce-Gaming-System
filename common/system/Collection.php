<?php

abstract class Collection {

    protected $entity = 'entity';
    protected $table  = 'table';
    protected $db     = null;


    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getOne($where = null) {
        $sql = " SELECT * FROM {$this->table} ";
        $sql.= "WHERE id = '{$where}'";

        $result = $this->db->query($sql);
        
        $row = $this->db->translate($result);

        if($row === null) {
           return;
        }
        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }
    
    public function getAll($where = array(), $limit = -1, $offset = 0, $orderBy = array('id', 'DESC'), $rand = 0)
    {
        $sql = " SELECT * FROM {$this->table} ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }

        if ($rand == 1) {
            $sql.= " ORDER BY RAND() ";
        } else {
            $sql.= " ORDER BY {$orderBy[0]} {$orderBy[1]} ";
        }


        if ($limit > -1) {
            $sql.= "Limit {$limit}";

            if ($offset > 0) {
                $sql.= " , {$offset}";
            }
        }

        $result = $this->db->query($sql);

        if ($result  === false) {
            $this->db->error();
        }

        $collection = array();
        while ($row = $this->db->translate($result)) {
            $entity = new $this->entity;
            $entityRow = $entity->init($row);

            $collection[] = $entityRow;
        }

        return $collection;
    }


    public function getDistinct() {

        $sql = "SELECT DISTINCT category FROM {$this->table}";

        $result = $this->db->query($sql);

        if ($result  === false) {
            $this->db->error();
        }

        $collection = array();

        while ($row = $this->db->translate($result)) {

            $entity = new $this->entity;
            $entityRow = $entity->init($row);

            $collection[] = $entityRow;
        }

        return $collection;
    }


    public function create($dataInput)
    {
        $sql="INSERT INTO {$this->table} SET ";

        $numItems = count($dataInput);
        $i = 0;
        foreach ($dataInput as $key => $value) {
            if (++$i == $numItems) {
                $sql.="{$key}='{$value}' ";
            } else {
                $sql.="{$key}='{$value}', ";
            }
        }

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return $this->db->lastId();
    }


    public function update($id, $dataInput)
    {
        $sql =  "UPDATE {$this->table} SET ";
        $numItems = count($dataInput);
        $i = 0;
        foreach ($dataInput as $key => $value) {
            if (++$i == $numItems) {
                $sql.="{$key}='{$value}' ";
            } else {
                $sql.="{$key}='{$value}', ";
            }
        }
        $sql .= "WHERE id = {$id}";

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }

    public function updateStatus($code, $dataInput)
    {
        $sql =  " UPDATE {$this->table} SET ";
        $numItems = count($dataInput);
        $i = 0;
        foreach ($dataInput as $key => $value) {
            if (++$i == $numItems) {
                $sql.="{$key}='{$value}' ";
            } else {
                $sql.="{$key}='{$value}', ";
            }
        }
        $sql .= "WHERE confirm_code = {$code}";

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }



    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }

    abstract public function save(Entity $entity);

}