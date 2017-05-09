<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Bibliotheque
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $superficie;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateInstallationInternet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFormation;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Internet", mappedBy="bibliotheque")
     */
    private $internet;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Fondoc", mappedBy="bibliotheque")
     */
    private $fondoc;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Animation", mappedBy="bibliotheque")
     */
    private $animation;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Espace", mappedBy="bibliotheque")
     */
    private $espace;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Adherent", mappedBy="bibliotheque")
     */
    private $adherent;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\SocialMedia", mappedBy="bibliotheque")
     */
    private $socialMedia;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Remarque", mappedBy="bibliotheque")
     */
    private $remarque;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Catalogue", inversedBy="bibliotheque")
     * @ORM\JoinColumn(name="catalogue_id", referencedColumnName="id")
     */
    private $catalogue;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Province", inversedBy="bibliotheque")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     */
    private $province;

    /**
     * @ORM\ManyToMany(targetEntity="PFE\DashBundle\Entity\Tutelle", mappedBy="bibliotheque")
     */
    private $tutelle;
}