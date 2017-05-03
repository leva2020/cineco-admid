<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\InfoAreaPqrsRepository")
 * @ORM\Table(name="info_area_pqrs")
 */
class InfoAreaPqrs
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;
    
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_area;
    

    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return InfoAreaPqrs
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set id_area
     *
     * @param integer $idArea
     * @return InfoAreaPqrs
     */
    public function setIdArea($idArea)
    {
        $this->id_area = $idArea;

        return $this;
    }

    /**
     * Get id_area
     *
     * @return integer 
     */
    public function getIdArea()
    {
        return $this->id_area;
    }
}
