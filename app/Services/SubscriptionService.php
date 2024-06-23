<?php

namespace App\Services;

use App\Models\Website;
use App\Models\Subscriber;
use App\Traits\ResponseTrait;
use App\Interfaces\SubscriptionInterface;

class SubscriptionService implements SubscriptionInterface
{
    use ResponseTrait;

    public function subscribe(array $data, $websiteId)
    {
        $website = Website::find($websiteId);
        if (!$website) {
            return $this->responseData(404, false, "Invalid Website");
        }
        
        if ($website->subscribers()->where("email", $data['email'])->exists()) {
            return $this->successResponse("User has already been subscribed to this website", code: 200);
        }
    
        $website->subscribers()->create($data);
    
        return $this->successResponse("User subscribed successfully", code: 201);
    }    
}