<?php

namespace App\Interfaces;

interface PostInterface
{
    public function createPost(array $data, $websiteId);
    public function getPost($websiteId);
}