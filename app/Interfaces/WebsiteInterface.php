<?php

namespace App\Interfaces;

interface WebsiteInterface
{
    /*
    * Create WebSite
    */
    public function createWebsite(array $data);
    
    /*
    * Get All WebSite
    */
    public function getWebsites();
}