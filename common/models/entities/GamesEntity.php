<?php

class GamesEntity extends Entity
{

    private $id;
    private $name_id;
    private $image;
    private $category_id;
    private $description_id;
    private $year_id;
    private $price;
    private $genre_id;

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
    public function getNameId()
    {
        return $this->name_id;
    }

    /**
     * @param mixed $name_id
     */
    public function setNameId($name_id)
    {
        $this->name_id = $name_id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getDescriptionId()
    {
        return $this->description_id;
    }

    /**
     * @param mixed $description_id
     */
    public function setDescriptionId($description_id)
    {
        $this->description_id = $description_id;
    }

    /**
     * @return mixed
     */
    public function getYearId()
    {
        return $this->year_id;
    }

    /**
     * @param mixed $year_id
     */
    public function setYearId($year_id)
    {
        $this->year_id = $year_id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genre_id;
    }

    /**
     * @param mixed $genre_id
     */
    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;
    }



}