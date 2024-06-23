<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;

class PostController extends Controller
{
    public function __construct(private PostInterface $post)
    {
    }

    public function create(PostRequest $request, $websiteId)
    {
        $data = $request->validated();
        return $this->post->createPost($data, $websiteId);
    }

    
    public function index($websiteId)
    {
        return $this->post->getPost($websiteId);
    }
}