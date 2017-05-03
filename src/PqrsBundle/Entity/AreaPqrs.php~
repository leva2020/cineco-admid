<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\AreaPqrsRepository")
 * @ORM\Table(name="area_pqrs")
 */
class AreaPqrs
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_area;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pqrs", inversedBy="areas_asignada")
     * @ORM\JoinColumn(name="pqrs_id", referencedColumnName="id", nullable=TRUE)
     **/
    protected $areas_pqrs;

    

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
     * Set id_area
     *
     * @param integer $idArea
     * @return AreaPqrs
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

    /**
     * Set areas_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $areasPqrs
     * @return AreaPqrs
     */
    public function setAreasPqrs(\PqrsBundle\Entity\Pqrs $areasPqrs = null)
    {
        $this->areas_pqrs = $areasPqrs;

        return $this;
    }

    /**
     * Get areas_pqrs
     *
     * @return \PqrsBundle\Entity\Pqrs 
     */
    public function getAreasPqrs()
    {
        return $this->areas_pqrs;
    }
}
