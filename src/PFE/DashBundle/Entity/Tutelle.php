<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tutelle
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
     * @ORM\ManyToMany(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="tutelle")
     * @ORM\JoinTable(
     *     name="BibliothequeToTutelle",
     *     joinColumns={@ORM\JoinColumn(name="tutelle_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $bibliotheque;
}