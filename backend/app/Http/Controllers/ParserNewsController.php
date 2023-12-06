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
     * @OA\Post(
     *     path="/api/parse-news-sky",
     *     summary="Parse food news from news.sky.com and save it to the database.",
     *     tags={"News Parsing"},
     *     @OA\Response(
     *         response="200",
     *         description="Successfully parsed and saved to the database.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example="true")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Failed to parse or save to the database.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param ParseService $parseService
     * @return JsonResponse
     */
    public function skyParse(ParseService $parseService): JsonResponse
    {
        return response()->json(['success' => $parseService->parseNews(new SkyParserFactory(), SourceNews::Sky->value)]);
    }

    /**
     * @OA\Post(
     *     path="/api/parse-news-bbc",
     *     summary="Parse food news from bbc.co.uk and save it to the database.",
     *     tags={"News Parsing"},
     *     @OA\Response(
     *         response="200",
     *         description="Successfully parsed and saved to the database.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example="true")
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Failed to parse or save to the database.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param ParseService $parseService
     * @return JsonResponse
     */
    public function bbcParse(ParseService $parseService): JsonResponse
    {
        return response()->json(['success' => $parseService->parseNews(new BBCParserFactory(), SourceNews::BBC->value)]);
    }
}
