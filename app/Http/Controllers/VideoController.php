<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalErrorException;
use App\Http\Requests\CreateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Services\Video\VideoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    /**
     * @param VideoService $service
     */
    public function __construct(
        private VideoService $service
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function index(): JsonResponse
    {
        try {
            $videos = $this->service->getVideos();
            return response()->json(VideoResource::collection($videos));
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param CreateVideoRequest $request
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function store(CreateVideoRequest $request): JsonResponse
    {
        try {
            $createdVideo = $this->service->create($request->validated());
            return response()->json(new VideoResource($createdVideo));
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function show($id): JsonResponse
    {
        try {
            return response()->json(new VideoResource($this->service->getVideoById($id)));
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param CreateVideoRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function update(CreateVideoRequest $request, int $id): JsonResponse
    {
        try {
            $updatedVideo = $this->service->updateById($request->validated(), $id);
            return response()->json(new VideoResource($updatedVideo));
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->service->deleteById($id);
            return response()->json(['message' => 'Video Deleted']);
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }
}
