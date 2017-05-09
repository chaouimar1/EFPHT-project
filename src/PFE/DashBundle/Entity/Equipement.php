<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Equipement
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
    private $nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typeequipement", inversedBy="equipement")
     * @ORM\JoinColumn(name="typeequipement_id", referencedColumnName="id")
     */
    private $typeequipement;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Espace", inversedBy="equipement")
     * @ORM\JoinColumn(name="espace_id", referencedColumnName="id")
     */
    private $espace;
}