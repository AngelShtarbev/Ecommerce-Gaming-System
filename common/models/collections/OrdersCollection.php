<?php

class OrdersCollection extends Collection {

    protected $entity = 'OrdersEntity';
    protected $table = 'orders';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'order_ID' => $this->db->escape($entity->getOrderID()),
            'customer_username' => $this->db->escape($entity->getCustomerUsername()),
            'order_info' => $this->db->escape($entity->getOrderInfo()),
            'order_amount' => $this->db->escape($entity->getOrderAmount()),
            'shipping' => $this->db->escape($entity->getShipping()),
            'customer_phone' => $this->db->escape($entity->getCustomerPhone()),
            'customer_address' => $this->db->escape($entity->getCustomerAddress()),
            'customer_email' => $this->db->escape($entity->getCustomerEmail()),
            'payment_method' => $this->db->escape($entity->getPaymentMethod()),
            'order_date' => $this->db->escape($entity->getOrderDate()),
            'status' => $this->db->escape($this->db->escape($entity->getStatus())),
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