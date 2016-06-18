<?php

class AdminCollection extends Collection {

    protected $entity = 'AdminsEntity';
    protected $table  = 'administrators';

    /**
     * @param Entity $entity
     */
    public function save(Entity $entity)
    {
        $dataInput = array(
            'username' => $this->db->escape($entity->getUsername()),
            'password' => $this->db->escape($entity->getPassword()),
            'email'   => $this->db->escape($entity->getEmail()),
            'firstname' => $this->db->escape($entity->getFirstname()),
        );

        if ($entity->getId() > 0) {
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
