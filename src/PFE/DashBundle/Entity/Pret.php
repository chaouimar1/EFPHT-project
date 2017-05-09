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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\JoinColumn(name="typepret_id", referencedColumnName="id")
     */
    private $typepret;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typefondoc", inversedBy="pret")
     * @ORM\JoinColumn(name="typefondoc_id", referencedColumnName="id")
     */
    private $typefondoc;
}