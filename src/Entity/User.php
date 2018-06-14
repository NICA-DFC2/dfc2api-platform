<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Swagger\Annotations as SWG;

/**
 * Entité qui représente un User. Certain champs sont hydratés par un appel aux services web GIMEL. Héritage de la class BaseUser de FOSUserBundle.
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"user", "user-read"}},
 *     "denormalization_context"={"groups"={"user", "user-write"}}
 * })
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
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Email du user.", type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Nom complet du user.", type="string", maxLength=255)
     */
    protected $fullname;

    /**
     * @Groups({"user-write"})
     *
     * @var string
     * @SWG\Property(description="Mot de passe du user.", type="string")
     */
    protected $plainPassword;

    /**
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Login/Nom d'utilisateur du user.", type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="La raison sociale du user.", type="string")
     */
    protected $raison_sociale;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Code unique du user.", type="string")
     */
    protected $code;

    /**
     * @Groups({"user", "user-read"})
     *
     * @var integer
     * @SWG\Property(description="Identifiant unique Evolubat du user.", type="integer")
     */
    protected $id_cli;

    /**
     * @Groups({"user", "user-read"})
     *
     * @var integer
     * @SWG\Property(description="Numéro unique Evolubat du user.", type="integer")
     */
    protected $no_cli;

    /**
     * @Groups({"user", "user-read"})
     *
     * @var string
     * @SWG\Property(description="Identifiant unique Evolubat du dépot d'appartenance du user.", type="string")
     */
    protected $id_depot_cli;

    /**
     * @Groups({"user", "user-read"})
     *
     * @var string
     * @SWG\Property(description="Nom du dépot d'appartenance du user.", type="string")
     */
    protected $nom_depot_cli;


    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function isUser(UserInterface $user = null): bool
    {
        return $user instanceof self && $user->id === $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    /**
     * @return string
     */
    public function getRaisonSociale(): string
    {
        return $this->raison_sociale;
    }

    /**
     * @param string $raison_sociale
     */
    public function setRaisonSociale(string $raison_sociale): void
    {
        $this->raison_sociale = $raison_sociale;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getIdCli(): int
    {
        return $this->id_cli;
    }

    /**
     * @param string $id_cli
     */
    public function setIdCli(int $id_cli): void
    {
        $this->id_cli = $id_cli;
    }

    /**
     * @return string
     */
    public function getNoCli(): int
    {
        return $this->no_cli;
    }

    /**
     * @param string $no_cli
     */
    public function setNoCli(int $no_cli): void
    {
        $this->no_cli = $no_cli;
    }

    /**
     * @return integer
     */
    public function getIdDepotCli(): int
    {
        return $this->id_depot_cli;
    }

    /**
     * @param integer $id_depot_cli
     */
    public function setIdDepotCli(int $id_depot_cli): void
    {
        $this->id_depot_cli = $id_depot_cli;
    }

    /**
     * @return string
     */
    public function getNomDepotCli(): string
    {
        return $this->nom_depot_cli;
    }

    /**
     * @param string $nom_depot_cli
     */
    public function setNomDepotCli(string $nom_depot_cli): void
    {
        $this->nom_depot_cli = $nom_depot_cli;
    }


}