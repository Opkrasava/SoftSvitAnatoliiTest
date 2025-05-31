<?php

namespace App\Entity;

use App\Repository\CompanyCountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyCountryRepository::class)]
class CompanyCountry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'companyCountry')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    #[ORM\Column(type: 'json')]
    private array $state = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company { return $this->company; }
    public function setCompany(Company $company): self
    {
        $this->company = $company;
        return $this;
    }

    public function getState(): array { return $this->state; }
    public function setState(array $state): self
    {
        $this->state = $state;
        return $this;
    }
}
