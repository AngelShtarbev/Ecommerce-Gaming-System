<?php

class AboutCollection extends Collection {

    protected $entity = 'AboutEntity';
    protected $table  = 'about';

    public function save(Entity $entity) {

        $dataInput = array(
            'location' => $this->db->escape($entity->getLocation()),
            'phone' => $this->db->escape($entity->getPhone()),
            'email'   => $this->db->escape($entity->getEmail()),
            'skype' => $this->db->escape($entity->getSkype()),
            'description' => $this->db->escape($entity->getDescription()),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }

    }
}