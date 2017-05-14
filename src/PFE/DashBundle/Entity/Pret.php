<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Pret
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typepret", inversedBy="pret")
     * @ORM\JoinColumn(name="typepret_id", referencedColumnName="id", nullable=false)
     */
    private $typepret;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typefondoc", inversedBy="pret")
     * @ORM\JoinColumn(name="typefondoc_id", referencedColumnName="id", nullable=false)
     */
    private $typefondoc;

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
     * Set description
     *
     * @param string $description
     * @return Pret
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     * @return Pret
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return integer 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Pret
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set typepret
     *
     * @param \PFE\DashBundle\Entity\Typepret $typepret
     * @return Pret
     */
    public function setTypepret(\PFE\DashBundle\Entity\Typepret $typepret)
    {
        $this->typepret = $typepret;

        return $this;
    }

    /**
     * Get typepret
     *
     * @return \PFE\DashBundle\Entity\Typepret 
     */
    public function getTypepret()
    {
        return $this->typepret;
    }

    /**
     * Set typefondoc
     *
     * @param \PFE\DashBundle\Entity\Typefondoc $typefondoc
     * @return Pret
     */
    public function setTypefondoc(\PFE\DashBundle\Entity\Typefondoc $typefondoc)
    {
        $this->typefondoc = $typefondoc;

        return $this;
    }

    /**
     * Get typefondoc
     *
     * @return \PFE\DashBundle\Entity\Typefondoc 
     */
    public function getTypefondoc()
    {
        return $this->typefondoc;
    }
}
