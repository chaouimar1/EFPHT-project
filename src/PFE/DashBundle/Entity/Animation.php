<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Animation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $occamenheb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publicvise;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateExposition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publicTotal;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typeanimation", inversedBy="animation")
     * @ORM\JoinColumn(name="typeanimation_id", referencedColumnName="id")
     */
    private $typeanimation;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="animation")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id")
     */
    private $bibliotheque;
}