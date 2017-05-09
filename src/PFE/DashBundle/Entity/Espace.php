<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Espace
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDisponible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombrePlaceAssises;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Equipement", mappedBy="espace")
     */
    private $equipement;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typeespace", inversedBy="espace")
     * @ORM\JoinColumn(name="typeespace_id", referencedColumnName="id")
     */
    private $typeespace;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="espace")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id")
     */
    private $bibliotheque;
}