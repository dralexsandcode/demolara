<?php

declare(strict_types=1);


namespace App\src\Shared\Repositories\Contracts;

use Illuminate\Http\Request;

interface BaseCrudRepositoryInterface
{
    public function createFromArray(array $data);

    public function createFromJson(string $data);

    public function updateFromArrayById(array $data, string $id);

    public function updateFromArrayByUuid(array $data, string $uuid);

    public function deleteById(string $id): string;

    public function deleteByUuid(string $uuid): string;

    public function findById(string $id);

    public function findByUuid(string $uuid);

    public function getAll(Request $request);

    public function onCreatedReBuildMapModelData(array $validated);
}