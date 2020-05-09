<?php

namespace App\CQRS\User\Domain;

use App\CQRS\Task\Domain\Task;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\CQRS\User\Infrastructure\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\CQRS\Task\Domain\Task", mappedBy="createdBy")
     */
    private $createdTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\CQRS\Task\Domain\Task", mappedBy="createdFor")
     */
    private $assignedTasks;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->isActive = true;
        $this->createdTasks = new ArrayCollection();
        $this->assignedTasks = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return Collection|Task[]
     */
    public function getCreatedTasks(): Collection
    {
        return $this->createdTasks;
    }

    public function addCreatedTask(Task $createdTask): self
    {
        if (!$this->createdTasks->contains($createdTask)) {
            $this->createdTasks[] = $createdTask;
            $createdTask->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCreatedTask(Task $createdTask): self
    {
        if ($this->createdTasks->contains($createdTask)) {
            $this->createdTasks->removeElement($createdTask);
            // set the owning side to null (unless already changed)
            if ($createdTask->getCreatedBy() === $this) {
                $createdTask->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getAssignedTasks(): Collection
    {
        return $this->assignedTasks;
    }

    public function addAssignedTask(Task $assignedTask): self
    {
        if (!$this->assignedTasks->contains($assignedTask)) {
            $this->assignedTasks[] = $assignedTask;
            $assignedTask->setCreatedFor($this);
        }

        return $this;
    }

    public function removeAssignedTask(Task $assignedTasks): self
    {
        if ($this->assignedTasks->contains($assignedTasks)) {
            $this->assignedTasks->removeElement($assignedTasks);
            // set the owning side to null (unless already changed)
            if ($assignedTasks->getCreatedFor() === $this) {
                $assignedTasks->setCreatedFor(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}