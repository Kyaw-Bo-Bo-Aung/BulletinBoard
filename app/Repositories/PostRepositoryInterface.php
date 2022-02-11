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

    public function storeWithCsv($request);

    public function publishPost($request ,$post);

    public function getDataTableData($request);

}