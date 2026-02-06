<?php

namespace App\Entity;

use App\Repository\ReservationStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ReservationStatusRepository::class)]
class ReservationStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    private string $name;

    /**
     * @var Collection<int, ReservationRequest>
     */
    #[ORM\OneToMany(targetEntity: ReservationRequest::class, mappedBy: 'status')]
    private Collection $reservationRequests;

    public function __construct()
    {
        $this->reservationRequests = new ArrayCollection();
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

    /**
     * @return Collection<int, ReservationRequest>
     */
    public function getReservationRequests(): Collection
    {
        return $this->reservationRequests;
    }

    public function addReservationRequest(ReservationRequest $reservationRequest): static
    {
        if (!$this->reservationRequests->contains($reservationRequest)) {
            $this->reservationRequests->add($reservationRequest);
            $reservationRequest->setStatus($this);
        }

        return $this;
    }

    public function removeReservationRequest(ReservationRequest $reservationRequest): static
    {
        $this->reservationRequests->removeElement($reservationRequest);
        return $this;
    }
}
