<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Repositories\NewsRepository;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(NewsRepository::getAllNews());
    }

    /**
     * @throws ClientException
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(NewsRepository::getNewsById($id));
    }
}
