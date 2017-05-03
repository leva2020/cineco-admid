<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\CiudadRepository")
 * @ORM\Table(name="ciudad")
 */
class Ciudad
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
    protected $id_ciudad;

    

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
     * @return Ciudad
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
     * Set id_ciudad
     *
     * @param integer $idCiudad
     * @return Ciudad
     */
    public function setIdCiudad($idCiudad)
    {
        $this->id_ciudad = $idCiudad;

        return $this;
    }

    /**
     * Get id_ciudad
     *
     * @return integer 
     */
    public function getIdCiudad()
    {
        return $this->id_ciudad;
    }
}
