<?php

namespace App\Repository\General;

use App\Entities\UserEntity;
use App\Enums\DBTables;
use App\Repository\General\Interface\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected string $table = DBTables::USERS->value;

    public function create(array $data): int
    {
        return $this->query()->insertGetId(
            array_merge(
                $data,
                $this->createdAt(),
                $this->updatedAt()
            )
        );
    }

    public function findById(int $id): null|UserEntity
    {
        $user = $this->query()->find($id);

        if ($user === null) {
            return null;
        }

        return $this->toEntity($user);
    }

    public function toEntity(object $data): UserEntity
    {
        $user = new UserEntity();
        $user->id = $data->id;
        $user->firstName = $data->first_name;
        $user->lastName = $data->last_name;
        $user->email = $data->email;
        $user->role = $data->role;

        return $user;
    }
}
