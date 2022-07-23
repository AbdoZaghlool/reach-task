<?php

namespace App\Models\Traits;

trait HasAdvertisements
{
    /**
     * check if there is any advertisements under this category
     *
     * @return boolean
     */
    public function hasAdvertisements(): bool
    {
        return $this->advertisements()->exists();
    }
}
