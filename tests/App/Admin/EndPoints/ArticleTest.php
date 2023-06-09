<?php

use Illuminate\Http\Response;
use Database\Factories\Article\ArticleFactory;
use Database\Factories\Client\UserFactory;
use Domain\Client\Enums\PermissionEnum;
use Domain\Article\States\Ready;
use Shared\Enums\MorphEnum;

beforeEach(function () {
    Artisan::call('passport:install');
    $this->articles = ArticleFactory::new()->count(10)->create();
    $this->readyArticle = ArticleFactory::new([
        'state' => Ready::class
    ])->create();
    $this->admin = UserFactory::new()->admin()->create();
    $this->comment = [
        'commentable_type' => MorphEnum::ARTICLE->value,
        'article_id' => $this->articles->first()->id,
        'user_id' => $this->admin->id,
        'comment' => 'new comment'
    ];
    actingAs($this->admin, ['admin']);
});

it('gets paginated articles for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::ARTICLE_VIEW->value, ['admin']);
    $this->get(route('admin.article.index'))->assertStatus(Response::HTTP_OK);
});

it('gets an article for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::ARTICLE_VIEW->value, ['admin']);
    $this->get(route('admin.article.show', ['article' => $this->articles->first()->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('approves an article for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::ARTICLE_APPROVE->value, ['admin']);
    $this->put(route('admin.article.approve', ['article' => $this->readyArticle->id]))
        ->assertStatus(Response::HTTP_OK);
});

it('deletes an article for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::ARTICLE_DELETE->value, ['admin']);
    $this->delete(route('admin.article.destroy', ['article' => $this->articles->first()]))
        ->assertStatus(Response::HTTP_OK);
});

it('stores an article for the admin', function () {
    actWithPermission($this->admin, PermissionEnum::COMMENT_CREATE->value, ['admin']);
    $this->post(route('admin.article.comment.create'), $this->comment)
        ->assertStatus(Response::HTTP_OK);
});
