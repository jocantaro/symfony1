<?php

namespace testBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pelicula
 *
 * @ORM\Table(name="pelicula")
 * @ORM\Entity(repositoryClass="testBundle\Repository\PeliculaRepository")
 */
class Pelicula
{

    /**
     * @ORM\ManyToOne(targetEntity="Director", inversedBy="pelicula")
     * @ORM\JoinColumn(name="director_id", referencedColumnName="id")
     */

    protected $director;

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
     * @ORM\Column(name="Titulo", type="string", length=255)
     */
    private $titulo;


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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Pelicula
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set director
     *
     * @param \testBundle\Entity\Director $director
     *
     * @return Pelicula
     */
    public function setDirector(\testBundle\Entity\Director $director = null)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return \testBundle\Entity\Director
     */
    public function getDirector()
    {
        return $this->director;
    }
}
