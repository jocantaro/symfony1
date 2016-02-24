<?php

namespace testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Director
 *
 * @ORM\Table(name="director")
 * @ORM\Entity(repositoryClass="testBundle\Repository\DirectorRepository")
 */
class Director
{


    /**
     * @ORM\OneToMany(targetEntity="Pelicula", mappedBy="director")
     */


    protected $pelicula;


    public function __construct()
    {
        $this->pelicula = new ArrayCollection();
    }


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=55)
     *
     * @Assert\NotBlank()
     */

    private $nombre;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="Apellido", type="string", length=100)
     */
    private $apellido;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Director
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Director
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Add pelicula
     *
     * @param \testBundle\Entity\Pelicula $pelicula
     *
     * @return Director
     */
    public function addPelicula(\testBundle\Entity\Pelicula $pelicula)
    {
        $this->pelicula[] = $pelicula;

        return $this;
    }

    /**
     * Remove pelicula
     *
     * @param \testBundle\Entity\Pelicula $pelicula
     */
    public function removePelicula(\testBundle\Entity\Pelicula $pelicula)
    {
        $this->pelicula->removeElement($pelicula);
    }

    /**
     * Get pelicula
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPelicula()
    {
        return $this->pelicula;
    }
}
