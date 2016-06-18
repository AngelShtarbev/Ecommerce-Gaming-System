<?php

class GamesYearCollection extends Collection {

    protected $entity = 'GamesYearEntity';
    protected $table = 'games_year';

    public function getGameYear($where = null) {
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


    public function save(Entity $entity)
    {
        $dataInput = array(
            'year' => $this->db->escape($entity->getYear()),
            'game' => $this->db->escape($entity->getGame()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }
}