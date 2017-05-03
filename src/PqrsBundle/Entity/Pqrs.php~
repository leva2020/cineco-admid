<?php

namespace PqrsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PqrsBundle\Entity\PqrsRepository")
 * @ORM\Table(name="pqrs")
 */
class Pqrs
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
    protected $tipo_comunicacion;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $fecha_hora;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $fecha_modificacion;

    /**
     * @ORM\Column(type="integer")
     */
    protected $fecha_registro;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    protected $pelicula;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre_usuario;
    
    /**
     * @ORM\Column(type="integer", nullable=TRUE)
     */
    protected $documento_usuario;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    protected $direccion_correspondencia;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $correo;
    
    /**
    * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    protected $telefono;
    
    /**
     * @ORM\Column(type="string", length=10000)
     */
    protected $motivo;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $estado;
    
    /**
     * @ORM\OneToMany(targetEntity="Respuesta", mappedBy="pqrs")
     */
    protected $respuesta;
    
    /**
     * @ORM\OneToMany(targetEntity="Adjunto", mappedBy="pqrs")
     */
    protected $adjuntos_pqrs;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $ciudad;    
    
    /**
     * @ORM\Column(type="integer", nullable=TRUE)
     */
    protected $multiplex;
    
    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="area_pqrs")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=TRUE)
     **/
    protected $area;
    
    /**
     * @ORM\OneToMany(targetEntity="AreaPqrs", mappedBy="areas_pqrs")
     */
    protected $areas_asignada;
    
    /**
     * @ORM\ManyToOne(targetEntity="Portal", inversedBy="portal_pqrs")
     * @ORM\JoinColumn(name="portal_id", referencedColumnName="id", nullable=TRUE)
     **/
    protected $portal;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->respuesta = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adjuntos_pqrs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->areas_asignada = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tipo_comunicacion
     *
     * @param integer $tipoComunicacion
     * @return Pqrs
     */
    public function setTipoComunicacion($tipoComunicacion)
    {
        $this->tipo_comunicacion = $tipoComunicacion;

        return $this;
    }

    /**
     * Get tipo_comunicacion
     *
     * @return integer 
     */
    public function getTipoComunicacion()
    {
        return $this->tipo_comunicacion;
    }

    /**
     * Set fecha_hora
     *
     * @param integer $fechaHora
     * @return Pqrs
     */
    public function setFechaHora($fechaHora)
    {
        $this->fecha_hora = $fechaHora;

        return $this;
    }

    /**
     * Get fecha_hora
     *
     * @return integer 
     */
    public function getFechaHora()
    {
        return $this->fecha_hora;
    }

    /**
     * Set fecha_modificacion
     *
     * @param integer $fechaModificacion
     * @return Pqrs
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fecha_modificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fecha_modificacion
     *
     * @return integer 
     */
    public function getFechaModificacion()
    {
        return $this->fecha_modificacion;
    }

    /**
     * Set fecha_registro
     *
     * @param integer $fechaRegistro
     * @return Pqrs
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fecha_registro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fecha_registro
     *
     * @return integer 
     */
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

    /**
     * Set pelicula
     *
     * @param string $pelicula
     * @return Pqrs
     */
    public function setPelicula($pelicula)
    {
        $this->pelicula = $pelicula;

        return $this;
    }

    /**
     * Get pelicula
     *
     * @return string 
     */
    public function getPelicula()
    {
        return $this->pelicula;
    }

    /**
     * Set nombre_usuario
     *
     * @param string $nombreUsuario
     * @return Pqrs
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombre_usuario = $nombreUsuario;

        return $this;
    }

    /**
     * Get nombre_usuario
     *
     * @return string 
     */
    public function getNombreUsuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Set documento_usuario
     *
     * @param integer $documentoUsuario
     * @return Pqrs
     */
    public function setDocumentoUsuario($documentoUsuario)
    {
        $this->documento_usuario = $documentoUsuario;

        return $this;
    }

    /**
     * Get documento_usuario
     *
     * @return integer 
     */
    public function getDocumentoUsuario()
    {
        return $this->documento_usuario;
    }

    /**
     * Set direccion_correspondencia
     *
     * @param string $direccionCorrespondencia
     * @return Pqrs
     */
    public function setDireccionCorrespondencia($direccionCorrespondencia)
    {
        $this->direccion_correspondencia = $direccionCorrespondencia;

        return $this;
    }

    /**
     * Get direccion_correspondencia
     *
     * @return string 
     */
    public function getDireccionCorrespondencia()
    {
        return $this->direccion_correspondencia;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Pqrs
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Pqrs
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set motivo
     *
     * @param string $motivo
     * @return Pqrs
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return string 
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Pqrs
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
     * Set ciudad
     *
     * @param integer $ciudad
     * @return Pqrs
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return integer 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set multiplex
     *
     * @param integer $multiplex
     * @return Pqrs
     */
    public function setMultiplex($multiplex)
    {
        $this->multiplex = $multiplex;

        return $this;
    }

    /**
     * Get multiplex
     *
     * @return integer 
     */
    public function getMultiplex()
    {
        return $this->multiplex;
    }

    /**
     * Add respuesta
     *
     * @param \PqrsBundle\Entity\Respuesta $respuesta
     * @return Pqrs
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
     * Add adjuntos_pqrs
     *
     * @param \PqrsBundle\Entity\Adjunto $adjuntosPqrs
     * @return Pqrs
     */
    public function addAdjuntosPqr(\PqrsBundle\Entity\Adjunto $adjuntosPqrs)
    {
        $this->adjuntos_pqrs[] = $adjuntosPqrs;

        return $this;
    }

    /**
     * Remove adjuntos_pqrs
     *
     * @param \PqrsBundle\Entity\Adjunto $adjuntosPqrs
     */
    public function removeAdjuntosPqr(\PqrsBundle\Entity\Adjunto $adjuntosPqrs)
    {
        $this->adjuntos_pqrs->removeElement($adjuntosPqrs);
    }

    /**
     * Get adjuntos_pqrs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdjuntosPqrs()
    {
        return $this->adjuntos_pqrs;
    }

    /**
     * Set area
     *
     * @param \PqrsBundle\Entity\Area $area
     * @return Pqrs
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
     * Add areas_asignada
     *
     * @param \PqrsBundle\Entity\AreaPqrs $areasAsignada
     * @return Pqrs
     */
    public function addAreasAsignada(\PqrsBundle\Entity\AreaPqrs $areasAsignada)
    {
        $this->areas_asignada[] = $areasAsignada;

        return $this;
    }

    /**
     * Remove areas_asignada
     *
     * @param \PqrsBundle\Entity\AreaPqrs $areasAsignada
     */
    public function removeAreasAsignada(\PqrsBundle\Entity\AreaPqrs $areasAsignada)
    {
        $this->areas_asignada->removeElement($areasAsignada);
    }

    /**
     * Get areas_asignada
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreasAsignada()
    {
        return $this->areas_asignada;
    }

    /**
     * Set portal
     *
     * @param integer $portal
     * @return Pqrs
     */
    public function setPortal($portal)
    {
        $this->portal = $portal;

        return $this;
    }

    /**
     * Get portal
     *
     * @return integer 
     */
    public function getPortal()
    {
        return $this->portal;
    }

    /**
     * Set area_ant
     *
     * @param \PqrsBundle\Entity\Area $areaAnt
     * @return Pqrs
     */
    public function setAreaAnt(\PqrsBundle\Entity\Area $areaAnt = null)
    {
        $this->area_ant = $areaAnt;

        return $this;
    }

    /**
     * Get area_ant
     *
     * @return \PqrsBundle\Entity\Area 
     */
    public function getAreaAnt()
    {
        return $this->area_ant;
    }
}
