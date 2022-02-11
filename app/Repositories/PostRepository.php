<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function all() {
        return Post::orderBy('created_at', 'desc')
                    ->with('author')
                    ->where('is_published', 1)
                    ->get()
                    ->map(function($post) {
                        return [
                            'title' => $post->title,
                            'content' => $post->content,
                            'author' => $post->author->name,
                            'is_published' => $post->is_published,
                            'created_at' => $post->created_at->diffForHumans(),
                            'updated_at' => $post->updated_at->diffForHumans(),
                        ];
                    });
    }

    public function storePost($post)
    {
        Post::create([
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function getOwnPosts()
    {
        return Post::where('user_id', auth()->user()->id)
                    ->with('author')
                    ->get()
                    ->map(function($post) {
                        return [
                            'id' => $post->id,
                            'title' => $post->title,
                            'content' => $post->content,
                            'is_published' => $post->is_published,
                            'author' => $post->author->name,
                            'created_at' => $post->created_at,
                            'updated_at' => $post->updated_at,
                        ];
                    });
    }

    public function getOnePost($post)
    {
        return $post;
    }

    public function updatePost($request ,$post)
    {
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id
        ]);
    }

    public function deletePost($post)
    {
        $post->delete();
    }

    public function storeWithCsv($request)
    {
        $file = $request->file('csv');

        $f = fopen($file, 'r');
        $counter = 0;

        DB::beginTransaction();
            while (($line = fgetcsv($f)) !== FALSE) {  //$line = ['', '']
                // \Log::info($line);
                $counter++;
                if($counter != 1) {
                    
                    if($line[0] == '' || $line[1]=='') {
                        DB::rollback();
                        // \Log::info($line);
                    }else {                    
                        Post::create([
                            'title' => $line[0],
                            'content' => $line[1],
                            'user_id' => auth()->user()->id,
                        ]);
                        DB::commit();
                    }
                }
              }
        
          fclose($f);
    }

    public function publishPost($request ,$post)
    {
        $is_published = $post->is_published;
        
        if($is_published == 1) { 
            $status = 0; 
        } else { 
            $status = 1;
        }
        
        $post->update([
            'is_published' => $status,
        ]);

    }


    public function getDataTableData($request) 
    {
        $posts = $this->getOwnPosts();
        
        $recordsTotal = $posts->count();
        $recordsFiltered = $recordsTotal;
        
        $columns = $request->columns; // [ 0 => id[], 1 => title[], ...... ]
        $orders = $request->order[0]; // [ 0 => [ columns: 0, dir: asc ] ]
        $column_index = $request->order[0]['column'];
        $column_name = $columns[$column_index]['data']; 
        $direction = $request->order[0]['dir'];
        // OrderBy($table_column, $dir)
        
        $start = $request->start;
        $limit = $request->length;
        // skip($start)->take($limit)
        $search = $request->search['value'];
        \Log::info($start);
        
        if(!$search) {

            if($direction === 'asc') {
                $result = $posts->sortBy($column_name, SORT_NATURAL | SORT_FLAG_CASE)->skip($start)->take($limit)->values();
            }else {
                $result = $posts->sortByDesc($column_name, SORT_NATURAL | SORT_FLAG_CASE)->skip($start)->take($limit)->values();
            }

            // $result = Post::where('user_id', auth()->user()->id)
            //         ->skip($start)
            //         ->take($limit)
            //         ->orderBy($column_name, $direction)
            //         ->get();

        } else {

            // $result = $posts->filter(function ($post, $key) {
            //     \Log::info([$post, $key]);
            // });
            // $result = Post::where('user_id', auth()->user()->id)
            //         ->skip($start)
            //         ->skip($start)
            //         ->take($limit)
            //         ->where( 'id' , 'ILIKE', '%'.$search.'%')
            //         ->orWhere('title', 'ILIKE', '%'.$search.'%')
            //         ->orWhere('content', 'ILIKE', '%'.$search.'%')
            //         ->orderBy($column_name, $direction)
            //         ->get();
            
            $result = Post::where('user_id', auth()->user()->id)
                            ->where(function($q) use($search) {
                                $q->orWhere('title', 'ILIKE', '%'.$search.'%')
                                    ->orWhere('title', 'ILIKE', '%'.$search.'%')
                                    ->orWhere('content', 'ILIKE', '%'.$search.'%');
                            })
                            ->orderBy($column_name, $direction)
                            ->get();
            
            \Log::info($result);
        

            $recordsFiltered = Post::where('user_id', auth()->user()->id)
                                    ->where(function($q) use($search) {
                                        $q->orWhere('title', 'ILIKE', '%'.$search.'%')
                                            ->orWhere('title', 'ILIKE', '%'.$search.'%')
                                            ->orWhere('content', 'ILIKE', '%'.$search.'%');
                                    })
                                    ->get()
                                    ->count();
        }

        return [
            'data' => $result,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
        ];

    }
}