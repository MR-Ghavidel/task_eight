<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Services\CommentPropertyService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function __construct(
        private readonly CommentPropertyService $commentPropertyService,
    )
    {
    }

    public function create(CreateCommentRequest $request): JsonResponse
    {
        return response()->json($this->commentPropertyService->commentProperty($request->validated()), Response::HTTP_CREATED);
    }

}
