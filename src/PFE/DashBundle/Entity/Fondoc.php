<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Fondoc
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
    private $nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typefondoc", inversedBy="fondoc")
     * @ORM\JoinColumn(name="typefondoc_id", referencedColumnName="id")
     */
    private $typefondoc;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="fondoc")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id")
     */
    private $bibliotheque;
}