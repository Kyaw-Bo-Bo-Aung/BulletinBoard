<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\PostRepository;
use GrahamCampbell\ResultType\Error;
use App\Http\Requests\CsvUploadRequest;
use App\Http\Requests\CreatePostRequest;
use SebastianBergmann\Environment\Console;
use app\Repositories\PostRepositoryInterface;
use League\Flysystem\Exception;

class PostController extends Controller
{
    private $post_repository;

    public function __construct(PostRepositoryInterface $post_repository)
    {
        $this->post_repository = $post_repository;
    }

    public function index()
    {
        $posts = $this->post_repository->all();

        // return $posts;
        return view('allposts', compact('posts'));
    }

    public function create()
    {
        return view('create-post');
    }

    public function store(CreatePostRequest $request)
    {
        $this->post_repository->storePost($request);

        return redirect('/posts/all')->with('success', 'New post created successfully.');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $my_post = $this->post_repository->getOnePost($post);

        if($my_post->user_id != auth()->user()->id) return back();

        return view('edit-post', compact('my_post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->post_repository->updatePost($request ,$post);

        return redirect('/posts/manage')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if($post->user_id != auth()->user()->id) return back();

        $this->post_repository->deletePost($post);
        
        return redirect('/posts/manage')->with('success', 'Post has been deleted.');
    }

    public function managePosts()
    {
        $posts = $this->post_repository->getOwnPosts();

        return view('manage-posts', compact('posts'));
    }

    public function serverSideData (Request $request) {
        $posts = $this->post_repository->getDataTableData($request);

        return response()->json([
            'draw' => $request->draw,
            'data' => $posts['data'],
            'recordsTotal' => $posts['recordsTotal'],
            'recordsFiltered' => $posts['recordsFiltered'],
        ]);
    }

    public function uploadUsingCSV()
    {
        return view('upload-using-csv');
    }

    public function downloadSampleCSV()
    {
        $pathToFile = base_path()."/htdocs/assets/files/sample.csv";

        return response()->download($pathToFile);
    }

    public function storeUsingCSV(CsvUploadRequest $request)
    {
        $this->post_repository->storeWithCsv($request);

        return redirect('/posts/manage')->with('success', 'Posts inserted successfully.');
    }

    public function publish(Request $request, Post $post) 
    {
        if($post->user_id != auth()->user()->id) return back();

        $this->post_repository->publishPost($request, $post);

        return redirect('/posts/manage')->with('success', 'Post status has been changed.');
    }
}
