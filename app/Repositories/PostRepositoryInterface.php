<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function all();

    public function storePost($post);
    
    public function getOwnPosts();

    public function getOnePost($post);
    
    public function updatePost($request ,$post);

    public function deletePost($post);
   
}