<?php

namespace App\Entity;

use App\Repository\ReservationStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationStatusRepository::class)]
class ReservationStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

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
        if ($this->reservationRequests->removeElement($reservationRequest)) {
            // set the owning side to null (unless already changed)
            if ($reservationRequest->getStatus() === $this) {
                $reservationRequest->setStatus(null);
            }
        }

        return $this;
    }
}
