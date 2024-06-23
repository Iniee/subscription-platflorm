<?php

namespace App\Services;

use App\Models\Website;
use App\Jobs\SendPostEmails;
use App\Traits\ResponseTrait;
use App\Interfaces\PostInterface;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Cache;


class PostService implements PostInterface
{
    use ResponseTrait;

    public function createPost(array $data, $websiteId)
    {
        $website = Website::find($websiteId);
        if (!$website) {
            return $this->responseData(404, false, "Invalid WebSite");
        }
        $post = $website->posts()->create($data);

        // Clear cache for this website's posts
        Cache::forget("website_{$websiteId}_posts");

        // Dispatch job to send emails
        dispatch(new SendPostEmails($post));

        return $this->successResponse("Website Post created successfully", code: 201);
    }

    public function getPost($websiteId)
    {
        $website = Website::find($websiteId);
        if (!$website) {
            return $this->responseData(404, false, "Invalid WebSite");
        }
        $post = $website->posts()->get();

        return $this->successResponse("Website Posts returned successfully", PostResource::collection($post), code: 200);
    }
}