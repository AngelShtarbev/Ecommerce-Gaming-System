<?php

class GamesAdditionalCollection extends Collection {

    protected $entity = 'GamesAdditionalEntity';
    protected $table  = 'games_additional_info';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'image_id'  => $this->db->escape($entity->getImageId()),
            'name_id' => $this->db->escape($entity->getNameId()),
            'video_id'  => $this->db->escape($entity->getVideoId()),
            'games_id'=> $this->db->escape($entity->getGamesId()),
            'category_id' => $this->db->escape($entity->getCategoryId()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }

    public function getGameAdditional($where = null) {

        $sql = " SELECT  id , name_id , image_id , video_id , games_id , category_id FROM {$this->table} ";
        $sql.= " WHERE id = '{$where}' ";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        if($row === null) {
            return;
        }
        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }


    public function getGameById($where = null) {
        $sql = " SELECT id , video_id FROM {$this->table} ";
        $sql.= " WHERE games_id = '{$where}' ";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        if($row === null) {
            return;
        }
        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }

    public function getGameVideoById($where = null) {
        $sql = " SELECT DISTINCT video_id FROM {$this->table} ";
        $sql.= " WHERE games_id = '{$where}' ";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        if($row === null) {
            return;
        }
        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }

    public function getGameImageById($where = array(), $limit = -1, $offset = 0, $orderBy = array('id', 'DESC'), $rand = 0) {
        $sql = " SELECT DISTINCT image_id FROM {$this->table} ";

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


    public function getAll($where = array(), $limit = -1, $offset = 0 , $orderBy = array('id', 'DESC'), $like = array(), $rand = 0 )
    {
        $sql = " SELECT gi.id , gn.game AS name_id, ggi.image AS image_id, gv.video AS video_id, g.id AS games_id, gc.category AS category_id
       FROM {$this->table} AS gi ";

        $sql .= " JOIN games_names AS gn
       ON gi.name_id = gn.id
        JOIN games_categories as gc
       ON gi.category_id = gc.id
        JOIN games_gallery_images as ggi
       ON gi.image_id = ggi.id
        JOIN games_videos as gv
       ON gi.video_id = gv.id
        JOIN games as g
       ON gi.games_id = g.id ";

        $sql.= " WHERE 1=1 ";

        if (!empty($like)) {
            $sql.= " AND gn.{$like[0]} LIKE '%{$like[1]}%' ";
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

    public function getGameGalleryImages($where = null) {

        $sql = " SELECT gi.id , gn.game AS name_id, ggi.image AS image_id, gv.video AS video_id, g.id AS games_id, gc.category AS category_id
       FROM {$this->table} AS gi ";

        $sql .= " JOIN games_names AS gn
       ON gi.name_id = gn.id
        JOIN games_categories as gc
       ON gi.category_id = gc.id
        JOIN games_gallery_images as ggi
       ON gi.image_id = ggi.id
        JOIN games_videos as gv
       ON gi.video_id = gv.id
        JOIN games as g
       ON gi.games_id = g.id ";

        $sql.= " WHERE gi.games_id = '{$where}' ";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        if($row === null) {
            return;
        }
        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE games_id = {$id}";

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }

}