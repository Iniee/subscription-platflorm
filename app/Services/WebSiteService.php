<?php

namespace App\Services;

use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use App\Interfaces\WebsiteInterface;
use App\Traits\ResponseTrait;

class WebSiteService implements WebsiteInterface
{
    use ResponseTrait;

    public function createWebsite(array $data)
    {
        $website = Website::create($data);

        return $this->successResponse("Website Created Successfully", code:201);
    }
    
    public function getWebsites()
    {
        $website = Website::all();

        return $this->successResponse("Websites Returned Successfully", WebsiteResource::collection($website), code:201);
    }
}