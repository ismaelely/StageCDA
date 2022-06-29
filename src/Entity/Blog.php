<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
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
     * @ORM\Column(type="datetime_immutable")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="blogs")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="blog")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=CommentsBlog::class, mappedBy="blog", cascade={"persist"}, orphanRemoval=true)
     */
    private $commentsBlogs;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->commentsBlogs = new ArrayCollection();
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

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->Date;
    }

    public function setDate(\DateTimeImmutable $Date): self
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
            $image->setBlog($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getBlog() === $this) {
                $image->setBlog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommentsBlog>
     */
    public function getCommentsBlogs(): Collection
    {
        return $this->commentsBlogs;
    }

    public function addCommentsBlog(CommentsBlog $commentsBlog): self
    {
        if (!$this->commentsBlogs->contains($commentsBlog)) {
            $this->commentsBlogs[] = $commentsBlog;
            $commentsBlog->setBlog($this);
        }

        return $this;
    }

    public function removeCommentsBlog(CommentsBlog $commentsBlog): self
    {
        if ($this->commentsBlogs->removeElement($commentsBlog)) {
            // set the owning side to null (unless already changed)
            if ($commentsBlog->getBlog() === $this) {
                $commentsBlog->setBlog(null);
            }
        }

        return $this;
    }

    public function _toString()
    {
        return $this->Title;
    }
}
