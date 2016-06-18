<?php

class UsersEntity extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $firstname;
    protected $confirm_code;
    protected $active;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getConfirmCode()
    {
        return $this->confirm_code;
    }

    /**
     * @param mixed $confirm_code
     */
    public function setConfirmCode($confirm_code)
    {
        $this->confirm_code = $confirm_code;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }






}
