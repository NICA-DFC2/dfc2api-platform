<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * Entité qui représente un User.
 *
 * Héritage de la classe BaseUser de FOSUserBundle.
 *
 * @ORM\Entity
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
     * @SWG\Property(description="Identifiant unique d'un user.", type="integer")
     */
    protected $id;

    /**
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Email d'un user.", type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Nom complet d'un user.", type="string", maxLength=255)
     */
    protected $fullname;

    /**
     * @Groups({"user-write"})
     *
     * @var string
     * @SWG\Property(description="Mot de passe d'un user.", type="string")
     */
    protected $plainPassword;

    /**
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Login/Nom d'utilisateur d'un user.", type="string")
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=25, nullable=true )
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Code client d'un user. Hydratation de la propriété par un appel web service GIMEL", type="string", maxLength=25)
     */
    protected $codCli;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user"})
     *
     * @var string
     * @SWG\Property(description="Identifiant unique du logiciel Evolubat d'un user. Hydratation de la propriété par un appel web service GIMEL", type="integer")
     */
    protected $idCli;



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
     * @return mixed
     */
    public function getCodCli(): ?string
    {
        return $this->codCli;
    }

    /**
     * @param mixed $codCli
     */
    public function setCodCli(?string $codCli): void
    {
        $this->codCli = $codCli;
    }

    /**
     * @return mixed
     */
    public function getIdCli(): ?int
    {
        return $this->idCli;
    }

    /**
     * @param mixed $idCli
     */
    public function setIdCli(?int $idCli): void
    {
        $this->idCli = $idCli;
    }


}