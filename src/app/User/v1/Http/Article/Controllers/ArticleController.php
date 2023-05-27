<?php

namespace App\User\v1\Http\Article\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Article\Requests\CreateArticleRequest;
use App\User\v1\Http\Article\Requests\UpdateArticleRequest;
use Domain\Article\DataTransferObjects\ArticleData;
use Domain\Article\Facades\ArticleFacade;
use Domain\Article\Models\Article;
use App\User\v1\Http\Article\Resources\ArticleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', new Article());

        $articles = ArticleFacade::index();

        return ArticleResource::paginatedCollection($articles);
    }

    public function show(string $article): JsonResponse
    {
        $this->authorize('view', new Article());

        $article = ArticleFacade::show($article);

        return $article
            ? $this->okResponse(ArticleResource::make($article))
            : $this->failedResponse();
    }

    public function store(CreateArticleRequest $request): JsonResponse
    {
        $this->authorize('create', Article::class);

        DB::beginTransaction();

        try {
            $article = ArticleFacade::store($request->all());
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return $article
            ? $this->okResponse(ArticleResource::make($article))
            : $this->failedResponse();
    }

    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $this->authorize('update', $article);

        DB::beginTransaction();

        try {
            $result = ArticleFacade::update(ArticleData::from($request));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Article $article): JsonResponse
    {
        $this->authorize('delete', $article);

        $result = ArticleFacade::destroy($article->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function getAuthorArticles(Request $request): JsonResponse
    {
        $this->authorize('view', new Article());

        $articles = ArticleFacade::getAuthorArticles($request->user());

        return ArticleResource::paginatedCollection($articles);
    }

    public function ready(Article $article): JsonResponse
    {
        $this->authorize('update', $article);

        $result = ArticleFacade::ready($article->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
