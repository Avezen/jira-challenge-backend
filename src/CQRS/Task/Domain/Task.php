<?php

namespace App\CQRS\Task\Domain;

use App\CQRS\Category\Domain\Category;
use App\CQRS\Column\Domain\Column;
use App\CQRS\TaskStep\Domain\TaskStep;
use App\CQRS\User\Domain\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\CQRS\Task\Infrastructure\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\CQRS\Column\Domain\Column", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $column;

    /**
     * @ORM\OneToMany(targetEntity="App\CQRS\TaskStep\Domain\TaskStep", mappedBy="task")
     */
    private $taskSteps;

    /**
     * @ORM\ManyToOne(targetEntity="App\CQRS\Category\Domain\Category", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\CQRS\User\Domain\User", inversedBy="createdTasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\CQRS\User\Domain\User", inversedBy="assignedTasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdFor;

    public function __construct()
    {
        $this->taskSteps = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColumn(): ?Column
    {
        return $this->column;
    }

    public function setColumn(?Column $column): self
    {
        $this->column = $column;

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTaskSteps(): Collection
    {
        return $this->taskSteps;
    }

    public function addTaskStep(TaskStep $taskStep): self
    {
        if (!$this->taskSteps->contains($taskStep)) {
            $this->taskSteps[] = $taskStep;
            $taskStep->setTask($this);
        }

        return $this;
    }

    public function removeTaskStep(TaskStep $taskStep): self
    {
        if ($this->taskSteps->contains($taskStep)) {
            $this->taskSteps->removeElement($taskStep);
            // set the owning side to null (unless already changed)
            if ($taskStep->getTask() === $this) {
                $taskStep->setTask(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedFor(): ?User
    {
        return $this->createdFor;
    }

    public function setCreatedFor(?User $createdFor): self
    {
        $this->createdFor = $createdFor;

        return $this;
    }
}
