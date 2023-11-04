<?php

namespace App\Http\Controllers;

use App\Enums\SourceNews;
use App\Factories\ParserNews\BBCParserFactory;
use App\Factories\ParserNews\SkyParserFactory;
use App\Services\ParseService;
use Illuminate\Http\JsonResponse;

class ParserNewsController extends Controller
{

    /**
     * Parse food news from news.sky.com and save it to the database.
     *
     * @param ParseService $parseService
     * @return JsonResponse
     */
    public function skyParse(ParseService $parseService): JsonResponse
    {
        return response()->json($parseService->parseNews(new SkyParserFactory(), SourceNews::Sky->value));
    }

    /**
     * Parse food news from bbc.co.uk and save it to the database.
     *
     * @param ParseService $parseService
     * @return JsonResponse
     */
    public function bbcParse(ParseService $parseService): JsonResponse
    {
        return response()->json($parseService->parseNews(new BBCParserFactory(), SourceNews::BBC->value));
    }
}
