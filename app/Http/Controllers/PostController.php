<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Interface\Services\PostServiceInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    private $postServiceInterface;

    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }

    //post-read
    public function postList()
    {
        if (Auth::user()->role === 1) {
            $postList = $this->postServiceInterface->getUserPostList();
            $postCount = $postList->total();
            return view('post.post_list', compact('postList', 'postCount'));
        }
        $postList = $this->postServiceInterface->getAdminPostList();
        $postCount = $postList->total();
        return view('post.post_list', compact('postList', 'postCount'));

    }

    //post-delete
    public function postDelete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('post#postList');
    }

    //post-create
    public function postCreateConfirm(PostCreateRequest $request)
    {
        $postCreateConfirm = $this->postServiceInterface->getData($request);
        return view('post.post_create_confirm')
            ->with('postCreateConfirm', $postCreateConfirm);
    }

    //post-store
    public function postStore(Request $request)
    {
        $store = $this->postServiceInterface->getData($request);
        Post::create($store);
        return redirect()->route('post#postList');
    }

    //post-edit
    public function postEdit($id)
    {
        $edit = Post::where('id', $id)->first();
        return view('post.post_edit', compact('edit'));
    }

    public function postEditConfirm(Request $request, $id)
    {
        $editConfirm = $this->postServiceInterface->getEditData($request);
        return view('post.post_edit_confirm', compact('editConfirm', 'id'));
    }

    //post-update
    public function postUpdate(Request $request, $id)
    {
        $updateData = $this->postServiceInterface->getEditData($request);
        Post::where('id', $id)->update($updateData);
        return redirect()->route('post#postList');
    }

    //csv import
    public function showImportCSV()
    {
        return view('post.csv_upload');
    }

    public function importCSV(Request $request)
    {
        $this->postServiceInterface->uploadCSV($request);
        return redirect()->route('post#postList');

    }

    //csv export
    public function exportCSV()
    {
        $callback = $this->postServiceInterface->getCsvCallback();
        $headers = $this->postServiceInterface->getCsvHeaders();
        return Response::stream($callback, 200, $headers);

    }

}