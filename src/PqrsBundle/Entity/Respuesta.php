<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\RespuestaRepository")
 * @ORM\Table(name="respuesta")
 */
class Respuesta
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="text", length=2500)
     */
    protected $respuesta;

    /**
     * @ORM\ManyToMany(targetEntity="Causas", inversedBy="respuesta", cascade={"persist"})
     * @ORM\JoinTable(name="causa_respuesta")
     **/
    private $causa;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pqrs", inversedBy="respuesta")
     * @ORM\JoinColumn(name="pqrs_id", referencedColumnName="id", nullable=TRUE)
     **/
    private $pqrs;

    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="respuesta")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=TRUE)
     **/
    private $area;
    
    /**
     * @ORM\OneToMany(targetEntity="Adjunto", mappedBy="respuesta")
     */
    protected $adjuntos;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $estado;

    /**
     * @ORM\Column(type="integer", nullable=TRUE)
     */
    protected $comunicado;
    
    /**
     * @ORM\Column(type="integer", nullable=TRUE)
     */
    protected $comunicacion_previa;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $fecha;
    
    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="area_ant_res_pqrs")
     * @ORM\JoinColumn(name="area_ant_id", referencedColumnName="id", nullable=TRUE)
     **/
    protected $area_res_ant;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $usuario;
    
    /**
     * @ORM\ManyToMany(targetEntity="Copias", inversedBy="respuesta", cascade={"persist"})
     * @ORM\JoinTable(name="copia_respuesta")
     **/
    protected $copia;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->causa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adjuntos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->copia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set respuesta
     *
     * @param string $respuesta
     * @return Respuesta
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return string 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Respuesta
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set comunicado
     *
     * @param integer $comunicado
     * @return Respuesta
     */
    public function setComunicado($comunicado)
    {
        $this->comunicado = $comunicado;

        return $this;
    }

    /**
     * Get comunicado
     *
     * @return integer 
     */
    public function getComunicado()
    {
        return $this->comunicado;
    }

    /**
     * Set comunicacion_previa
     *
     * @param integer $comunicacionPrevia
     * @return Respuesta
     */
    public function setComunicacionPrevia($comunicacionPrevia)
    {
        $this->comunicacion_previa = $comunicacionPrevia;

        return $this;
    }

    /**
     * Get comunicacion_previa
     *
     * @return integer 
     */
    public function getComunicacionPrevia()
    {
        return $this->comunicacion_previa;
    }

    /**
     * Set fecha
     *
     * @param integer $fecha
     * @return Respuesta
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return integer 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Respuesta
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add causa
     *
     * @param \PqrsBundle\Entity\Causas $causa
     * @return Respuesta
     */
    public function addCausa(\PqrsBundle\Entity\Causas $causa)
    {
        $this->causa[] = $causa;

        return $this;
    }

    /**
     * Remove causa
     *
     * @param \PqrsBundle\Entity\Causas $causa
     */
    public function removeCausa(\PqrsBundle\Entity\Causas $causa)
    {
        $this->causa->removeElement($causa);
    }

    /**
     * Get causa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCausa()
    {
        return $this->causa;
    }

    /**
     * Set pqrs
     *
     * @param \PqrsBundle\Entity\Pqrs $pqrs
     * @return Respuesta
     */
    public function setPqrs(\PqrsBundle\Entity\Pqrs $pqrs = null)
    {
        $this->pqrs = $pqrs;

        return $this;
    }

    /**
     * Get pqrs
     *
     * @return \PqrsBundle\Entity\Pqrs 
     */
    public function getPqrs()
    {
        return $this->pqrs;
    }

    /**
     * Set area
     *
     * @param \PqrsBundle\Entity\Area $area
     * @return Respuesta
     */
    public function setArea(\PqrsBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \PqrsBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Add adjuntos
     *
     * @param \PqrsBundle\Entity\Adjunto $adjuntos
     * @return Respuesta
     */
    public function addAdjunto(\PqrsBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos[] = $adjuntos;

        return $this;
    }

    /**
     * Remove adjuntos
     *
     * @param \PqrsBundle\Entity\Adjunto $adjuntos
     */
    public function removeAdjunto(\PqrsBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos->removeElement($adjuntos);
    }

    /**
     * Get adjuntos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }

    /**
     * Set area_res_ant
     *
     * @param \PqrsBundle\Entity\Area $areaResAnt
     * @return Respuesta
     */
    public function setAreaResAnt(\PqrsBundle\Entity\Area $areaResAnt = null)
    {
        $this->area_res_ant = $areaResAnt;

        return $this;
    }

    /**
     * Get area_res_ant
     *
     * @return \PqrsBundle\Entity\Area 
     */
    public function getAreaResAnt()
    {
        return $this->area_res_ant;
    }

    /**
     * Add copia
     *
     * @param \PqrsBundle\Entity\Copias $copia
     * @return Respuesta
     */
    public function addCopium(\PqrsBundle\Entity\Copias $copia)
    {
        $this->copia[] = $copia;

        return $this;
    }

    /**
     * Remove copia
     *
     * @param \PqrsBundle\Entity\Copias $copia
     */
    public function removeCopium(\PqrsBundle\Entity\Copias $copia)
    {
        $this->copia->removeElement($copia);
    }

    /**
     * Get copia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCopia()
    {
        return $this->copia;
    }
}
