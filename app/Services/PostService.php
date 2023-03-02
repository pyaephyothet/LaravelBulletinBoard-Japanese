<?php

namespace App\Services;

use App\Interface\Services\PostServiceInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService implements PostServiceInterface
{

    public function getUserPostList()
    {
        $postList = Auth::user()->posts()
            ->join('users as create_user', 'posts.create_user_id', '=', 'create_user.id')
            ->join('users as updated_user', 'posts.updated_user_id', '=', 'updated_user.id')
            ->when(request('searchText'), function ($query) {
                $query->where('posts.title', 'like', '%' . request('searchText') . '%');
            })
            ->when(in_array(request('searchStatus'), [0, 1]), function ($query) {
                $query->where('posts.status', 'like', '%' . request('searchStatus') . '%');
            })
            ->orderBy('created_at', 'desc')
            ->select('posts.*', 'create_user.name as create_user', 'updated_user.name as updated_user')
            ->paginate(10);
        return $postList;
    }

    public function getAdminPostList()
    {
        $postList = DB::table('posts')
            ->when(request('searchText'), function ($query) {
                $query->where('posts.title', 'like', '%' . request('searchText') . '%');
            })
            ->when(in_array(request('searchStatus'), [0, 1]), function ($query) {
                $query->where('posts.status', 'like', '%' . request('searchStatus') . '%');
            })
            ->join('users as create_user', 'posts.create_user_id', '=', 'create_user.id')
            ->join('users as updated_user', 'posts.updated_user_id', '=', 'updated_user.id')
            ->select('posts.*', 'create_user.name as create_user', 'updated_user.name as updated_user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $postList;
    }

    public function uploadCSV($request)
    {
        $file = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($file));
        $header = array_shift($data);
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            $posts = User::select(['users.id', 'users.name'])
                ->where('users.name', $row['User'])
                ->get()->toArray();
            $postTitle = $row['Post Title'];
            $description = $row['Post Description'];
            $status = $row['Status'];
            $create_id = $row['create_user_id'];
            $update_id = $row['updated_user_id'];
            $user = $row['User'];

            if (count($posts) > 0) {
                foreach ($posts as $post) {
                    if ($user == $post['name']) {
                        Post::create([
                            'title' => $postTitle,
                            'description' => $description,
                            'Status' => $status,
                            'create_user_id' => $create_id,
                            'updated_user_id' => $update_id,
                        ]);
                    }
                }
            }
        }
    }

    public function getCsvHeaders()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=posts.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );
        return $headers;
    }

    public function getCsvCallback()
    {
        if (Auth::user()->role === 1) {
            $postList = Auth::user()->posts()
                ->leftJoin('users as create_user', 'posts.create_user_id', '=', 'create_user.id')
                ->leftJoin('users as updated_user', 'posts.updated_user_id', '=', 'updated_user.id')
                ->when(request('searchText'), function ($query) {
                    $query->where('posts.title', 'like', '%' . request('searchText') . '%');
                })
                ->when(in_array(request('searchStatus'), [0, 1]), function ($query) {
                    $query->where('posts.status', 'like', '%' . request('searchStatus') . '%');
                })
                ->orderBy('created_at', 'desc')
                ->select('posts.*', 'create_user.name as create_user', 'updated_user.name as updated_user')
                ->get();

        } else {
            //$postList = $this->getAdminPostList();
            $postList = DB::table('posts')
                ->when(request('searchText'), function ($query) {
                    $query->where('posts.title', 'like', '%' . request('searchText') . '%');
                })
                ->when(in_array(request('searchStatus'), [0, 1]), function ($query) {
                    $query->where('posts.status', 'like', '%' . request('searchStatus') . '%');
                })
                ->join('users as create_user', 'posts.create_user_id', '=', 'create_user.id')
                ->join('users as updated_user', 'posts.updated_user_id', '=', 'updated_user.id')
                ->select('posts.*', 'create_user.name as create_user', 'updated_user.name as updated_user')
                ->orderBy('created_at', 'desc')
                ->get();

        }

        $columns = array('Post Title', 'Post Description', 'Status', 'User', 'create_user_id', 'updated_user_id', 'created_at', 'updated_at');

        $callback = function () use ($postList, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($postList as $user) {
                $row = [];
                $row['Post Title'] = $user->title;
                $row['Post Description'] = $user->description;
                $row['Status'] = $user->status;
                $row['User'] = $user->create_user;
                $row['create_user_id'] = $user->create_user_id;
                $row['updated_user_id'] = $user->updated_user_id;
                $row['created_at'] = $user->created_at;
                $row['updated_at'] = $user->created_at;
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return $callback;

    }

    public function getData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'create_user_id' => Auth::user()->id,
            'updated_user_id' => Auth::user()->id,
            'deleted_user_id' => Auth::user()->id,
        ];
    }

    public function getEditData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'updated_user_id' => Auth::user()->id,
            'deleted_user_id' => Auth::user()->id,
        ];
    }
}