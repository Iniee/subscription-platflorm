<?php

namespace App\Http\Controllers;


use App\Interfaces\SubscriptionInterface;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct(private SubscriptionInterface $subscriptionService)
    {
    }

    public function subscribe(SubscriptionRequest $request, $websiteId)
    {
        $data = $request->validated();
        
        return $this->subscriptionService->subscribe($data, $websiteId);
    }
}