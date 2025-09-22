<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\ShowUserResource;
use App\Repository\General\Interface\UserRepositoryInterface;
use App\Validators\UserExistValidator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        return response()->json(['user_id' => $this->userRepository->create($request->validated())], Response::HTTP_CREATED);
    }

    public function getOneById(int $id): ShowUserResource
    {
        $user = $this->userRepository->findById($id);

        (new UserExistValidator())->validate(user: $user);

        return new ShowUserResource($user);
    }

}
