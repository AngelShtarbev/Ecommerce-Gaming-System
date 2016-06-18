<?php

class OrdersEntity extends Entity {

    private $id;
    private $order_ID;
    private $customer_username;
    private $order_info;
    private $order_amount;
    private $shipping;
    private $customer_phone;
    private $customer_address;
    private $customer_email;
    private $payment_method;
    private $order_date;
    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOrderID()
    {
        return $this->order_ID;
    }

    /**
     * @param mixed $oder_ID
     */
    public function setOrderID($order_ID)
    {
        $this->order_ID = $order_ID;
    }

    /**
     * @return mixed
     */
    public function getCustomerUsername()
    {
        return $this->customer_username;
    }

    /**
     * @param mixed $customer_username
     */
    public function setCustomerUsername($customer_username)
    {
        $this->customer_username = $customer_username;
    }

    /**
     * @return mixed
     */
    public function getOrderInfo()
    {
        return $this->order_info;
    }

    /**
     * @param mixed $order_info
     */
    public function setOrderInfo($order_info)
    {
        $this->order_info = $order_info;
    }

    /**
     * @return mixed
     */
    public function getOrderAmount()
    {
        return $this->order_amount;
    }

    /**
     * @param mixed $order_amount
     */
    public function setOrderAmount($order_amount)
    {
        $this->order_amount = $order_amount;
    }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return mixed
     */
    public function getCustomerPhone()
    {
        return $this->customer_phone;
    }

    /**
     * @param mixed $customer_phone
     */
    public function setCustomerPhone($customer_phone)
    {
        $this->customer_phone = $customer_phone;
    }

    /**
     * @return mixed
     */
    public function getCustomerAddress()
    {
        return $this->customer_address;
    }

    /**
     * @param mixed $customer_address
     */
    public function setCustomerAddress($customer_address)
    {
        $this->customer_address = $customer_address;
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->customer_email;
    }

    /**
     * @param mixed $customer_email
     */
    public function setCustomerEmail($customer_email)
    {
        $this->customer_email = $customer_email;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * @param mixed $payment_method
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @param mixed $order_date
     */
    public function setOrderDate($order_date)
    {
        $this->order_date = $order_date;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



}