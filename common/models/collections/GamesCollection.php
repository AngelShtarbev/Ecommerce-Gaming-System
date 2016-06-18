<?php

class GamesCollection extends Collection {

    protected $entity = 'GamesEntity';
    protected $table  = 'games';


    public function getGameById($where = null) {
        $sql = " SELECT id , name_id , category_id , description_id , year_id , image FROM {$this->table} ";
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


    public function getSingleGame($where = null) {
        $sql = " SELECT g.id, gn.game AS name_id, gc.category AS category_id, gd.description AS description_id, gy.year AS year_id, gg.genre AS genre_id, g.image AS image , g.price AS price
       FROM {$this->table} AS g ";

        $sql .= " LEFT JOIN games_names AS gn
       ON g.name_id = gn.id
       LEFT JOIN games_categories as gc
       ON g.category_id = gc.id
       LEFT JOIN games_description as gd
       ON g.description_id = gd.id
       LEFT JOIN games_year as gy
       ON g.year_id = gy.id
       LEFT JOIN games_genre as gg
       ON g.genre_id = gg.id ";

        $sql.= " WHERE g.id = '{$where}' ";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        if($row === null) {
            return;
        }
        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }


    public function getAll($where = array(), $limit = -1, $offset = 0 , $orderBy = array('id', 'DESC'), $like = array(), $rand = 0 )
    {
        $sql = " SELECT g.id, gn.game AS name_id, gc.category AS category_id, gd.description AS description_id, gy.year AS year_id, gg.genre AS genre_id, g.image AS image , g.price AS price
       FROM {$this->table} AS g ";

        $sql .= " LEFT JOIN games_names AS gn
       ON g.name_id = gn.id
       LEFT JOIN games_categories as gc
       ON g.category_id = gc.id
       LEFT JOIN games_description as gd
       ON g.description_id = gd.id
       LEFT JOIN games_year as gy
       ON g.year_id = gy.id
       LEFT JOIN games_genre as gg
       ON g.genre_id = gg.id ";

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

    public function getGameInfo($gameId)
    {
        $sql = " SELECT * FROM {$this->table}  WHERE id = '{$gameId}' ";


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

    public function getCategory($where = array(), $limit = -1, $offset = 0 , $like = array() ) {

        $sql = " SELECT g.id, gn.game AS name_id, gc.category AS category_id, gd.description AS description_id, gy.year AS year_id, gg.genre AS genre_id, g.image AS image , g.price AS price
       FROM {$this->table} AS g ";

        $sql .= " LEFT JOIN games_names AS gn
       ON g.name_id = gn.id
       LEFT JOIN games_categories as gc
       ON g.category_id = gc.id
       LEFT JOIN games_description as gd
       ON g.description_id = gd.id
       LEFT JOIN games_year as gy
       ON g.year_id = gy.id
       LEFT JOIN games_genre as gg
       ON g.genre_id = gg.id ";

        $sql.= " WHERE gc.category = '{$where}' ";

        if (!empty($like)) {
            $sql.= " AND gn.{$like[0]} LIKE '%{$like[1]}%' ";
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

    public function getSearchedGame($where = array(), $limit = -1, $offset = 0 , $like = array() ) {

        $sql = " SELECT g.id, gn.game AS name_id, gc.category AS category_id, gd.description AS description_id, gy.year AS year_id, gg.genre AS genre_id, g.image AS image , g.price AS price
       FROM {$this->table} AS g ";

        $sql .= " LEFT JOIN games_names AS gn
       ON g.name_id = gn.id
       LEFT JOIN games_categories as gc
       ON g.category_id = gc.id
       LEFT JOIN games_description as gd
       ON g.description_id = gd.id
       LEFT JOIN games_year as gy
       ON g.year_id = gy.id
       LEFT JOIN games_genre as gg
       ON g.genre_id = gg.id ";

        $sql.= " WHERE gn.game = '{$where}' ";

        if (!empty($like)) {
            $sql.= " AND gn.{$like[0]} LIKE '%{$like[1]}%' ";
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
            'name_id' => $this->db->escape($entity->getNameId()),
            'category_id' => $this->db->escape($entity->getCategoryId()),
            'description_id' => $this->db->escape($entity->getDescriptionId()),
            'year_id' => $this->db->escape($entity->getYearId()),
            'genre_id' => $this->db->escape($entity->getGenreId()),
            'image' => $this->db->escape($entity->getImage()),
            'price' => $this->db->escape($entity->getPrice()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }



}