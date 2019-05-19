<?php 

namespace App\Entity;

class UserSearch 
{
    /**
     * @var string|null
     */
    private $firstname;

    /**
     * @var string|null
     */
    private $lastname;

    /**
     * @var Status|null
     */
    private $status;

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return UserSearch
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return UserSearch
     */ 
    public function setLastName(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return Status|null
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * @param Status|null $status
     * @return UserSearch
     */
    public function setStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }
}