<?php

namespace App\Entity;

use App\Repository\ProjectChecklistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectChecklistRepository::class)]
class ProjectChecklist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $client = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ChecklistTemplate $template = null;

    /**
     * @var Collection<int, ProjectChecklistItem>
     */
    #[ORM\OneToMany(targetEntity: ProjectChecklistItem::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getTemplate(): ?ChecklistTemplate
    {
        return $this->template;
    }

    public function setTemplate(?ChecklistTemplate $template): static
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return Collection<int, ProjectChecklistItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(ProjectChecklistItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setProject($this);
        }

        return $this;
    }

    public function removeItem(ProjectChecklistItem $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getProject() === $this) {
                $item->setProject(null);
            }
        }

        return $this;
    }
}
