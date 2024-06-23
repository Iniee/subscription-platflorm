<?php

namespace App\Interfaces;

interface SubscriptionInterface
{
    public function subscribe(array $data, $websiteId);
}