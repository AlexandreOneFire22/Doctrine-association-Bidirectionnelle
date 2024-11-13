<?php

namespace App\Entity\OneToMany\Bidirectionnelle;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "posts")]
class Post
{
    #[ORM\Id]
    #[ORM\Column(name: "id_post", type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(name: "titre_post", type: "string", length: 200, nullable: false)]
    private string $titre;

    #[ORM\Column(name: "contenu_post", type: "text", nullable: false)]
    private string $contenu;

    #[ORM\Column(name: "date_creation_post", type: "datetime", nullable: false)]
    private \DateTime $createdAt;

    #[ORM\Column(name: "nb_likes_post", type: "integer")]
    private int $nbLikes;

    #[ORM\OneToMany(
        mappedBy: "post",
        targetEntity: Comment::class,
        cascade: ["persist", "remove"]
    )]
    private Collection $comments;

    public function __construct(string $titre, string $contenu, \DateTime $createdAt, int $nbLikes = 0)
    {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->createdAt = $createdAt;
        $this->nbLikes = $nbLikes;
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getNbLikes(): int
    {
        return $this->nbLikes;
    }

    public function setNbLikes(int $nbLikes): self
    {
        $this->nbLikes = $nbLikes;
        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            //$comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // Définir le côté propriétaire à null (sauf si déjà modifié)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
