<?php

namespace App\Entity;

interface TranslatableInterface
{
    public function getCode(): ?string;
    public function getCategory(): ?string;
    public function setDescription(?string $description): static;
}
