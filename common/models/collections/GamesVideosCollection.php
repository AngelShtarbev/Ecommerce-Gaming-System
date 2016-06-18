<?php

class GamesVideosCollection extends Collection {

    protected $table = 'games_videos';
    protected $entity = 'GamesVideosEntity';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'video' => $this->db->escape($entity->getVideo()),
            'game' => $this->db->escape($entity->getGame()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }

    public function getGameVideo($where = null) {
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

}