<?php

namespace App\Model;

class Person
{
    private int $age;
    private string $name;
    private bool $sportsperson;
    private ?\DateTime $createdAt;

    // Getters
    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // Issers
    public function isSportsperson(): bool
    {
        return $this->sportsperson;
    }

    // Setters
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSportsperson(bool $sportsperson): void
    {
        $this->sportsperson = $sportsperson;
    }

    public function setCreatedAt(\DateTime $createdAt = null): void
    {
        $this->createdAt = $createdAt;
    }
}