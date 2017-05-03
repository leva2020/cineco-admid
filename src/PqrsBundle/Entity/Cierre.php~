<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\CierreRepository")
 * @ORM\Table(name="cierre")
 */
class Cierre
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $id_multiplex;

    /**
     * @ORM\Column(type="integer")
     */
    protected $fecha_cierre_anterior;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $fecha_cierre;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $fecha_sistema;
       

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
     * Set id_multiplex
     *
     * @param string $idMultiplex
     * @return Cierre
     */
    public function setIdMultiplex($idMultiplex)
    {
        $this->id_multiplex = $idMultiplex;

        return $this;
    }

    /**
     * Get id_multiplex
     *
     * @return string 
     */
    public function getIdMultiplex()
    {
        return $this->id_multiplex;
    }

    /**
     * Set fecha_cierre_anterior
     *
     * @param integer $fechaCierreAnterior
     * @return Cierre
     */
    public function setFechaCierreAnterior($fechaCierreAnterior)
    {
        $this->fecha_cierre_anterior = $fechaCierreAnterior;

        return $this;
    }

    /**
     * Get fecha_cierre_anterior
     *
     * @return integer 
     */
    public function getFechaCierreAnterior()
    {
        return $this->fecha_cierre_anterior;
    }

    /**
     * Set fecha_cierre
     *
     * @param integer $fechaCierre
     * @return Cierre
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fecha_cierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fecha_cierre
     *
     * @return integer 
     */
    public function getFechaCierre()
    {
        return $this->fecha_cierre;
    }

    /**
     * Set fecha_sistema
     *
     * @param integer $fechaSistema
     * @return Cierre
     */
    public function setFechaSistema($fechaSistema)
    {
        $this->fecha_sistema = $fechaSistema;

        return $this;
    }

    /**
     * Get fecha_sistema
     *
     * @return integer 
     */
    public function getFechaSistema()
    {
        return $this->fecha_sistema;
    }
}
