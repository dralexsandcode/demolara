<?php

namespace App\src\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use App\src\Shared\Helpers\CollectionPaginator;
use App\src\Shared\Repositories\Contracts\BaseCrudRepositoryInterface;
use App\src\Shared\Traits\HttpResponsesTrait;
use App\src\Shared\Traits\PerPageTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseApiController extends Controller
{
    use HttpResponsesTrait,
        PerPageTrait;

    public function __construct(
        protected BaseCrudRepositoryInterface $repository,
        protected JsonResource $resourceTransformer
    ) {
    }
    public function index(Request $request): JsonResponse
    {
        $data = $this->repository->getAll($request);
        $response = $this->resourceTransformer::collection($data);
        $perPage = $this->perPage($request);
        $paginator = new CollectionPaginator(collect($response), $perPage);
        $responsePaginated = $paginator->toPaginate();

        return $this->httpResponseSuccess($responsePaginated);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->repository->createFromArray($request->all());
        $response = $this->resourceTransformer::make($data);

        return $this->httpResponseSuccess(
            $response,
        );
    }

    public function show(string $uuid): JsonResponse
    {
        $data = $this->repository->findByUuid($uuid);
        $response = $this->resourceTransformer::make($data);

        return $this->httpResponseSuccess(
            $response,
        );
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $dataRequest = $request->all();
        $data = $this->repository->updateFromArrayByUuid($dataRequest, $uuid);
        $response = $this->resourceTransformer::make($data);

        return $this->httpResponseSuccess($response);
    }

    public function destroy(string $uuid): JsonResponse
    {
        $data = $this->repository->deleteByUuid($uuid);

        return $this->httpResponseSuccess($data);
    }
}
