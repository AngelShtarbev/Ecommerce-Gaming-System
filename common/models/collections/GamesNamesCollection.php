<?php

class GamesNamesCollection extends Collection {

    protected $entity = 'GamesNamesEntity';
    protected $table = 'games_names';


    public function getGameName($where = null) {
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
            'game' => $this->db->escape($entity->getGame()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }
}