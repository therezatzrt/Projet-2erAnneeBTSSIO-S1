<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=MedecinRepository::class)
 * @UniqueEntity(
 * fields={"username"},
 *  entityClass="App\Entity\Utilisateur",
 * )
 */
class Medecin extends Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialiste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialiste(): ?string
    {
        return $this->specialiste;
    }

    public function setSpecialiste(string $specialiste): self
    {
        $this->specialiste = $specialiste;

        return $this;
    }
}
