<?php

class GamesGalleryImagesCollection extends Collection {

    protected $table = 'games_gallery_images';
    protected $entity = 'GamesGalleryImagesEntity';

    public function getGameGalleryImages($where = null) {
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

    public function getGameImage($where = array(), $limit = -1, $offset = 0, $orderBy = array('id', 'DESC'), $rand = 0) {
        $sql = " SELECT image FROM {$this->table} ";

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

    public function save(Entity $entity)
    {
        $dataInput = array(
            'image' => $this->db->escape($entity->getImage()),
            'game' => $this->db->escape($entity->getGame()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
}