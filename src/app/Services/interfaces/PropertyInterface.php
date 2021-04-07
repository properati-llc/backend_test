<?php

namespace App\Services\Interfaces;

interface PropertyInterface extends ServiceInterface
{
    public function countPropertiesNotPurchased(int $ownerId): ?int;
}
