<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Typefondoc
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
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMultimedia;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Fondoc", mappedBy="typefondoc")
     */
    private $fondoc;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Pret", mappedBy="typefondoc")
     */
    private $pret;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fondoc = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pret = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Typefondoc
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set isMultimedia
     *
     * @param boolean $isMultimedia
     * @return Typefondoc
     */
    public function setIsMultimedia($isMultimedia)
    {
        $this->isMultimedia = $isMultimedia;

        return $this;
    }

    /**
     * Get isMultimedia
     *
     * @return boolean 
     */
    public function getIsMultimedia()
    {
        return $this->isMultimedia;
    }

    /**
     * Add fondoc
     *
     * @param \PFE\DashBundle\Entity\Fondoc $fondoc
     * @return Typefondoc
     */
    public function addFondoc(\PFE\DashBundle\Entity\Fondoc $fondoc)
    {
        $this->fondoc[] = $fondoc;

        return $this;
    }

    /**
     * Remove fondoc
     *
     * @param \PFE\DashBundle\Entity\Fondoc $fondoc
     */
    public function removeFondoc(\PFE\DashBundle\Entity\Fondoc $fondoc)
    {
        $this->fondoc->removeElement($fondoc);
    }

    /**
     * Get fondoc
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFondoc()
    {
        return $this->fondoc;
    }

    /**
     * Add pret
     *
     * @param \PFE\DashBundle\Entity\Pret $pret
     * @return Typefondoc
     */
    public function addPret(\PFE\DashBundle\Entity\Pret $pret)
    {
        $this->pret[] = $pret;

        return $this;
    }

    /**
     * Remove pret
     *
     * @param \PFE\DashBundle\Entity\Pret $pret
     */
    public function removePret(\PFE\DashBundle\Entity\Pret $pret)
    {
        $this->pret->removeElement($pret);
    }

    /**
     * Get pret
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPret()
    {
        return $this->pret;
    }
}
