<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Entité qui représente un User. Certain champs sont hydratés par un appel aux services web GIMEL. Héritage de la class BaseUser de FOSUserBundle.
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ApiResource()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     * @SWG\Property(description="Identifiant unique du user.", type="integer")
     */
    protected $id;

    /**
     *
     * @var string
     * @SWG\Property(description="Email du user.", type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     * @SWG\Property(description="Nom complet du user.", type="string", maxLength=255)
     */
    protected $fullname;

    /**
     *
     * @var string
     * @SWG\Property(description="Mot de passe du user.", type="string")
     */
    protected $plainPassword;

    /**
     *
     * @var string
     * @SWG\Property(description="Login/Nom d'utilisateur du user.", type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @var string
     * @SWG\Property(description="La raison sociale du user.", type="string")
     */
    protected $raison_sociale;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @var string
     * @SWG\Property(description="Code unique du user.", type="string")
     */
    protected $code;

    /**
     *
     * @var integer
     * @SWG\Property(description="Identifiant unique Evolubat du user.", type="integer")
     */
    protected $id_cli = null;

    /**
     *
     * @var integer
     * @SWG\Property(description="Identifiant unique Evolubat du salarié.", type="integer")
     */
    protected $id_sal = null;

    /**
     *
     * @var integer
     * @SWG\Property(description="Numéro unique Evolubat du user.", type="integer")
     */
    protected $no_cli = null;

    /**
     *
     * @var string
     * @SWG\Property(description="Identifiant unique Evolubat du dépot d'appartenance du user.", type="string")
     */
    protected $id_depot_cli;

    /**
     *
     * @var string
     * @SWG\Property(description="Nom du dépot d'appartenance du user.", type="string")
     */
    protected $nom_depot_cli;


    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function isUser(UserInterface $user = null)
    {
        return $user instanceof self && $user->id === $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * @return string
     */
    public function getRaisonSociale()
    {
        return $this->raison_sociale;
    }

    /**
     * @param string $raison_sociale
     */
    public function setRaisonSociale($raison_sociale)
    {
        $this->raison_sociale = $raison_sociale;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return integer
     */
    public function getIdCli()
    {
        return $this->id_cli;
    }

    /**
     * @param integer $id_cli
     */
    public function setIdCli($id_cli)
    {
        $this->id_cli = $id_cli;
    }

    /**
     * @return integer
     */
    public function getIdSal()
    {
        return $this->id_sal;
    }

    /**
     * @param integer $id_sal
     */
    public function setIdSal($id_sal)
    {
        $this->id_sal = $id_sal;
    }

    /**
     * @return integer
     */
    public function getNoCli()
    {
        return $this->no_cli;
    }

    /**
     * @param integer $no_cli
     */
    public function setNoCli($no_cli)
    {
        $this->no_cli = $no_cli;
    }

    /**
     * @return integer
     */
    public function getIdDepotCli()
    {
        return $this->id_depot_cli;
    }

    /**
     * @param integer $id_depot_cli
     */
    public function setIdDepotCli($id_depot_cli)
    {
        $this->id_depot_cli = $id_depot_cli;
    }

    /**
     * @return string
     */
    public function getNomDepotCli()
    {
        return $this->nom_depot_cli;
    }

    /**
     * @param string $nom_depot_cli
     */
    public function setNomDepotCli($nom_depot_cli)
    {
        $this->nom_depot_cli = $nom_depot_cli;
    }


}