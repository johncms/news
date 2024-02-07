<?php

declare(strict_types=1);

use Johncms\News\Controllers\Admin\AdminArticleController;
use Johncms\News\Controllers\Admin\AdminController;
use Johncms\News\Controllers\Admin\AdminSectionController;
use Johncms\News\Controllers\ArticleController;
use Johncms\News\Controllers\CommentsController;
use Johncms\News\Controllers\SearchController;
use Johncms\News\Controllers\SectionController;
use Johncms\News\Controllers\VoteController;
use Johncms\Router\RouteCollection;
use Johncms\Users\Middlewares\AuthorizedUserMiddleware;
use Johncms\Users\Middlewares\HasRoleMiddleware;

return function (RouteCollection $router) {
    $router->group('/news', function (RouteCollection $route) {
        $route->get('/search/', [SearchController::class, 'index'])->setName('news.search');
        $route->get('/search_tags/', [SearchController::class, 'byTags'])->setName('news.searchByTags');
        $route->post('/add_vote/{article_id:number}/{type_vote:number}/', [VoteController::class, 'add'])->setName('news.addVote');
        $route->get('/comments/{article_id:number}/', [CommentsController::class, 'index'])->setName('news.comments');
        $route->post('/comments/add/{article_id:number}/', [CommentsController::class, 'add'])->setName('news.comments.add');
        $route->post('/comments/del/', [CommentsController::class, 'del'])->setName('news.comments.del');
        $route->post('/comments/upload_file/', [CommentsController::class, 'loadFile'])
            ->setName('news.uploadFile')
            ->addMiddleware(AuthorizedUserMiddleware::class);

        $route->get('/{category:path?}', [SectionController::class, 'index'])->setName('news.section');
        $route->get('/{category:path}/{article_code:slug}.html', [ArticleController::class, 'index'])->setName('news.sectionArticle');
        $route->get('/{article_code:slug}.html', [ArticleController::class, 'index'])->setName('news.article');
    });

    $router->group('/admin/news', function (RouteCollection $route) {
        $route->get('/', [AdminController::class, 'index'])->setName('news.admin.index');
        $route->get('/content/{section_id:number?}', [AdminController::class, 'section'])->setName('news.admin.section');
        $route->map(['GET', 'POST'], '/settings/', [AdminController::class, 'settings'])->setName('news.admin.settings');

        // Articles
        $route->map(['GET', 'POST'], '/edit_article/{article_id:number}/', [AdminArticleController::class, 'edit'])->setName('news.admin.article.edit');
        $route->map(['GET', 'POST'], '/add_article/{section_id:number?}', [AdminArticleController::class, 'add'])->setName('news.admin.article.add');
        $route->map(['GET', 'POST'], '/del_article/{article_id:number}/', [AdminArticleController::class, 'del'])->setName('news.admin.article.del');

        // Sections
        $route->map(['GET', 'POST'], '/add_section/{section_id:number?}', [AdminSectionController::class, 'add'])->setName('news.admin.sections.add');
        $route->map(['GET', 'POST'], '/edit_section/{section_id:number}/', [AdminSectionController::class, 'edit'])->setName('news.admin.sections.edit');
        $route->map(['GET', 'POST'], '/del_section/{section_id:number}/', [AdminSectionController::class, 'del'])->setName('news.admin.sections.del');

        // File uploader
        $route->post('/upload_file/', [AdminArticleController::class, 'loadFile'])->setName('news.admin.sections.loadFile');
    })->addMiddleware(new HasRoleMiddleware('admin'));
};
