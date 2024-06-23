<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\WebsiteInterface;
use App\Http\Requests\WebsiteRequest;

class WebSiteController extends Controller
{
    public function __construct(private WebsiteInterface $website)
    {
    }

    public function create(WebsiteRequest $request)
    {
        $data = $request->validated();
        return $this->website->createWebsite($data);
    }
    
    public function index()
    {
        return $this->website->getWebsites();
    }
}