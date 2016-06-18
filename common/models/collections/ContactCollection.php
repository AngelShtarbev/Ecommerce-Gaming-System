<?php

class ContactCollection extends Collection {

    protected $entity = 'ContactEntity';
    protected $table  = 'contact';


    public function save(Entity $entity) {

        $dataInput = array(
            'email' => $this->db->escape($entity->getEmail()),
            'subject' => $this->db->escape($entity->getSubject()),
            'message' => $this->db->escape($entity->getMessage())
        );

        if($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
             $this->create($dataInput);
        }
    }

    public function getAll($where = array(), $limit = -1, $offset = 0, $orderBy = array('id', 'DESC'),$like = array(), $rand = 0)
    {
        $sql = " SELECT * FROM {$this->table} ";

        $sql.= " WHERE 1=1 ";

        if (!empty($like)) {
            $sql.= " AND {$like[0]} LIKE '%{$like[1]}%' ";
        }

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
}