<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\AreaRepository")
 * @ORM\Table(name="area")
 */
class Area
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
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="area")
     **/
    protected $usuarios;
    
    /**
     * @ORM\OneToMany(targetEntity="Pqrs", mappedBy="area")
     */
    protected $area_pqrs;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="area_ant")
     */
    protected $area_ant_res_pqrs;
    
    /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="area")
     */
    protected $respuesta;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->area_pqrs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->respuesta = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Area
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
     * Add usuarios
     *
     * @param \PqrsBundle\Entity\Usuario $usuarios
     * @return Area
     */
    public function addUsuario(\PqrsBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \PqrsBundle\Entity\Usuario $usuarios
     */
    public function removeUsuario(\PqrsBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add area_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $areaPqrs
     * @return Area
     */
    public function addAreaPqr(\PqrsBundle\Entity\Pqrs $areaPqrs)
    {
        $this->area_pqrs[] = $areaPqrs;

        return $this;
    }

    /**
     * Remove area_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $areaPqrs
     */
    public function removeAreaPqr(\PqrsBundle\Entity\Pqrs $areaPqrs)
    {
        $this->area_pqrs->removeElement($areaPqrs);
    }

    /**
     * Get area_pqrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreaPqrs()
    {
        return $this->area_pqrs;
    }

    /**
     * Add respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     * @return Area
     */
    public function addRespuestum(\PqrsBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta[] = $respuesta;

        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     */
    public function removeRespuestum(\PqrsBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta->removeElement($respuesta);
    }

    /**
     * Get respuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Add area_ant_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $areaAntPqrs
     * @return Area
     */
    public function addAreaAntPqr(\PqrsBundle\Entity\Pqrs $areaAntPqrs)
    {
        $this->area_ant_pqrs[] = $areaAntPqrs;

        return $this;
    }

    /**
     * Remove area_ant_pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $areaAntPqrs
     */
    public function removeAreaAntPqr(\PqrsBundle\Entity\Pqrs $areaAntPqrs)
    {
        $this->area_ant_pqrs->removeElement($areaAntPqrs);
    }

    /**
     * Get area_ant_pqrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreaAntPqrs()
    {
        return $this->area_ant_pqrs;
    }

    /**
     * Add area_res_pqrs
     *
     * @param \PqrsBundle\Entity\Respuesta $areaResPqrs
     * @return Area
     */
    public function addAreaResPqr(\PqrsBundle\Entity\Respuesta $areaResPqrs)
    {
        $this->area_res_pqrs[] = $areaResPqrs;

        return $this;
    }

    /**
     * Remove area_res_pqrs
     *
     * @param \PqrsBundle\Entity\Respuesta $areaResPqrs
     */
    public function removeAreaResPqr(\PqrsBundle\Entity\Respuesta $areaResPqrs)
    {
        $this->area_res_pqrs->removeElement($areaResPqrs);
    }

    /**
     * Get area_res_pqrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreaResPqrs()
    {
        return $this->area_res_pqrs;
    }

    /**
     * Add area_ant_res_pqrs
     *
     * @param \PqrsBundle\Entity\Respuesta $areaAntResPqrs
     * @return Area
     */
    public function addAreaAntResPqr(\PqrsBundle\Entity\Respuesta $areaAntResPqrs)
    {
        $this->area_ant_res_pqrs[] = $areaAntResPqrs;

        return $this;
    }

    /**
     * Remove area_ant_res_pqrs
     *
     * @param \PqrsBundle\Entity\Respuesta $areaAntResPqrs
     */
    public function removeAreaAntResPqr(\PqrsBundle\Entity\Respuesta $areaAntResPqrs)
    {
        $this->area_ant_res_pqrs->removeElement($areaAntResPqrs);
    }

    /**
     * Get area_ant_res_pqrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreaAntResPqrs()
    {
        return $this->area_ant_res_pqrs;
    }
}
