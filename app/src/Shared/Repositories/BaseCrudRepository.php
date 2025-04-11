<?php

declare(strict_types=1);


namespace App\src\Shared\Repositories;

use App\src\Shared\Exceptions\ApiException;
use App\src\Shared\Repositories\Contracts\BaseCrudRepositoryInterface;
use App\src\Shared\Traits\SortingFromRequestTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BaseCrudRepository implements BaseCrudRepositoryInterface
{
    use SortingFromRequestTrait;

    public function __construct(
        protected Model $model,
        protected FormRequest $storeRequest,
        protected FormRequest $updateRequest,
    ) {
    }

    /**
     * @throws ApiException
     */
    public function getAll(Request $request): Collection
    {
        $sorting = $this->getSortingFromRequest($request);

        return $this->model::query()
            ->when(!empty($sorting), function ($query) use ($sorting) {
                foreach ($sorting as $field => $direction) {
                    $query->orderBy($field, $direction);
                }
            })
            ->get();
    }

    /**
     * @throws ApiException
     */
    public function createFromArray(array $data)
    {
        $rules = $this->storeRequest->rules();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            Log::error($validator->errors());
            throw new ApiException($validator->errors()->first(), 400);
        } else {
            $validated = $validator->getData();
            $validated = $this->onCreatedReBuildMapModelData($validated);

            return $this->model::create($validated);
        }
    }

    /**
     * @throws ApiException
     */
    public function createFromJson(string $data)
    {
        $arrayData = json_decode($data, true);

        return $this->createFromArray($arrayData);
    }

    /**
     * @throws ApiException
     */
    public function updateFromArrayById(array $data, string $id)
    {
        if (!$this->model::query()->where('id', $id)->exists()) {
            throw new ApiException("data with $id not found", 200);
        }

        $rules = $this->updateRequest->rules();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            Log::error($validator->errors());
            throw new ApiException($validator->errors()->first(), 400);
        } else {
            $validated = $validator->getData();

            return tap(
                $this->model::where('id', $id)->first(),
            )
                ->update($validated);
        }
    }

    /**
     * @throws ApiException
     */
    public function updateFromArrayByUuid(array $data, string $uuid)
    {
        if (is_numeric($uuid)) {
            return $this->updateFromArrayById($data, $uuid);
        }

        if (!Str::isUuid($uuid)) {
            throw new ApiException("$uuid is not valid UUID", 400);
        }

        if (!$this->model::query()->where('uuid', $uuid)->exists()) {
            throw new ApiException("data with $uuid not found", 200);
        }

        $rules = $this->updateRequest->rules();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            Log::error($validator->errors());
            throw new ApiException($validator->errors()->first(), 400);
        } else {
            $validated = $validator->getData();

            return tap(
                $this->model::where('uuid', $uuid)->first(),
            )
                ->update($validated);
        }
    }

    /**
     * @throws ApiException
     */
    public function findById(string $id)
    {
        if (!$this->model::query()->where('id', $id)->exists()) {
            throw new ApiException("data with $id not found", 200);
        }

        return $this->model::query()->where('id', $id)->first();
    }

    /**
     * @throws ApiException
     */
    public function findByUuid(string $uuid)
    {
        if (is_numeric($uuid)) {
            return $this->findById($uuid);
        }

        if (!Str::isUuid($uuid)) {
            throw new ApiException("$uuid is not valid UUID", 400);
        }

        if (!$this->model::query()->where('uuid', $uuid)->exists()) {
            throw new ApiException("data with $uuid not found", 200);
        }

        return $this->model::query()->where('uuid', $uuid)->first();
    }

    /**
     * @throws ApiException
     */
    public function deleteById(string $id): string
    {
        if (!$this->model::query()->where('id', $id)->exists()) {
            throw new ApiException("data with $id not found", 200);
        }

        $this->model::query()->where('id', $id)->first()->delete();

        return "$id deleted successfully";
    }

    /**
     * @throws ApiException
     */
    public function deleteByUuid(string $uuid): string
    {
        if (is_numeric($uuid)) {
            return $this->deleteById($uuid);
        }

        if (!Str::isUuid($uuid)) {
            throw new ApiException("$uuid is not valid UUID", 400);
        }

        if (!$this->model::query()->where('uuid', $uuid)->exists()) {
            throw new ApiException("data with $uuid not found", 200);
        }

        $this->model::query()->where('uuid', $uuid)->delete();

        return "$uuid deleted successfully";
    }

    public function onCreatedReBuildMapModelData(array $validated): array
    {
        return $validated;
    }

    public function getStoreRequestRules(): array
    {
        return $this->storeRequest->rules();
    }

    public function getUpdateRequestRules(): array
    {
        return $this->updateRequest->rules();
    }
}