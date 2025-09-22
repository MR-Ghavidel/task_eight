<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeReactionRequest;
use App\Services\ReactionPropertyService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReactionController extends Controller
{
    public function __construct(
        private readonly ReactionPropertyService $reactionPropertyService,
    )
    {
    }

    public function likeProperty(LikeReactionRequest $request): JsonResponse
    {
        return response()->json($this->reactionPropertyService->likeProperty($request->validated()))
            ->setStatusCode(Response::HTTP_CREATED);
    }

}
