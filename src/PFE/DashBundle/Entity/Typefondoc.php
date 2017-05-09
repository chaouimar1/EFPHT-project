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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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
}