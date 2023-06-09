<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Article\Models\Article;
use Domain\Article\Policies\ArticlePolicy;
use Domain\Category\Models\Category;
use Domain\Category\Policies\CategoryPolicy;
use Domain\Client\Models\BecomeAuthor;
use Domain\Client\Policies\BecomeAuthorPolicy;
use Domain\Comment\Models\Comment;
use Domain\Comment\Policies\CommentPolicy;
use Domain\Like\Models\Like;
use Domain\Like\Policies\LikePolicy;
use Domain\Plan\Models\Feature;
use Domain\Plan\Models\Plan;
use Domain\Plan\Policies\FeaturePolicy;
use Domain\Plan\Policies\PlanPolicy;
use Domain\Tag\Models\Tag;
use Domain\Tag\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Category::class => CategoryPolicy::class,
        Comment::class => CommentPolicy::class,
        Tag::class => TagPolicy::class,
        Like::class => LikePolicy::class,
        BecomeAuthor::class => BecomeAuthorPolicy::class,
        Plan::class => PlanPolicy::class,
        Feature::class => FeaturePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }
}
