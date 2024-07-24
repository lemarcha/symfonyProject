<?php

namespace App\Entity;

use App\Repository\WordFourRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WordFourRepository::class)
 */
class WordFour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez renseigner un mot !")
     * @Assert\Length(min=2, max=40,
     *   minMessage="Mot trop court ! Au moins 2 caractères",
     *   maxMessage="Mot trop long ! Maximum 40 caractères !"
     *   )
     * @Assert\Regex(
     *    pattern="/^[a-zA-Zàâçéèêëîïôûùüÿñæœ]+$/u",
     *    message="Le mot ne doit contenir que des lettres alphabétiques."
     *  )
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
