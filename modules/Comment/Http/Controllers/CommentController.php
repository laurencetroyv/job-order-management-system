<?php

namespace Modules\Comment\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Comment\Models\Comment;
use App\Http\Controllers\Controller;
use Modules\Comment\Http\Requests\CommentRequest;
use Modules\Comment\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CommentResource::collection(Comment::all());
    }

    public function store(CommentRequest $request): CommentResource
    {
        return new CommentResource(Comment::create($request->validated()));
    }

    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    public function update(CommentRequest $request, Comment $comment): CommentResource
    {
        $comment->update($request->validated());

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json();
    }
}
