<?php

namespace App\Entity;

use App\Repository\ActualitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActualitesRepository::class)
 */
class Actualites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="actualites")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="actualites")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=CommentsActu::class, mappedBy="actu", cascade={"persist"}, orphanRemoval=true)
     */
    private $commentsActus;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->commentsActus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->Date;
    }

    public function setDate(\DateTime $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getParent(): ?User
    {
        return $this->parent;
    }

    public function setParent(?User $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setActualites($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getActualites() === $this) {
                $image->setActualites(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommentsActu>
     */
    public function getCommentsActus(): Collection
    {
        return $this->commentsActus;
    }

    public function addCommentsActu(CommentsActu $commentsActu): self
    {
        if (!$this->commentsActus->contains($commentsActu)) {
            $this->commentsActus[] = $commentsActu;
            $commentsActu->setActu($this);
        }

        return $this;
    }

    public function removeCommentsActu(CommentsActu $commentsActu): self
    {
        if ($this->commentsActus->removeElement($commentsActu)) {
            // set the owning side to null (unless already changed)
            if ($commentsActu->getActu() === $this) {
                $commentsActu->setActu(null);
            }
        }

        return $this;
    }

    public function _toString()
    {
        return $this->Title;
    }
}
