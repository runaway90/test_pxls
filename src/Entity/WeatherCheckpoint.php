<?php

namespace App\Entity;

use App\Repository\WeatherCheckpointRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeatherCheckpointRepository::class)
 */
class WeatherCheckpoint
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $temperature;

    /**
     * @ORM\Column(type="float")
     */
    private $speedWind;

    /**
     * @ORM\Column(type="date")
     */
    private $checkDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getSpeedWind(): ?float
    {
        return $this->speedWind;
    }

    public function setSpeedWind(float $speedWind): self
    {
        $this->speedWind = $speedWind;

        return $this;
    }

    public function getCheckDate(): ?\DateTimeInterface
    {
        return $this->checkDate;
    }

    public function setCheckDate(\DateTimeInterface $checkDate): self
    {
        $this->checkDate = $checkDate;

        return $this;
    }
}
