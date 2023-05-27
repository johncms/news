<?php

/**
 * @var $user
 * @var $query
 * @var $articles \Johncms\News\Models\NewsArticle[]
 */

?>
@extends('system::layout/default')

@section('content')

    <div>
        <form action="<?= route('news.search') ?>" method="get" class="search-in-nav news-search mb-3" style="max-width: 500px;">
            <div class="input-with-inner-btn">
                <input name="query" type="text" minlength="4" placeholder="<?= __('Search query') ?>" value="<?= $query ?>" class="form-control pe-5 border-radius-12">
                <button type="submit" name="submit" value="1" class="btn icon-button">
                    <svg class="icon">
                        <use xlink:href="<?= asset('icons/sprite.svg') ?>#search"></use>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <div>
        <?php if ($articles !== null && $articles->count() > 0): ?>
            <?php foreach ($articles as $article): ?>
        <div class="new_post-item without_avatar">
            <a href="<?= $article->url ?>" class="post-title"><?= $article->name ?></a>
                <?php if ($article->preview_text_safe): ?>
            <div class="post-body pt-2"><?= $article->preview_text_safe ?></div>
            <?php endif ?>
            <div class="d-flex">
                <div class="text-muted forum-view-counter">
                    <svg class="icon download-button-icon mt-n1 me-1">
                        <use xlink:href="<?= asset('icons/sprite.svg') ?>#rating"/>
                    </svg>
                        <?php if ($article->rating > 0): ?>
                    <span class="text-success fw-bold"><?= $article->rating ?></span>
                    <?php elseif ($article->rating < 0): ?>
                    <span class="text-danger fw-bold"><?= $article->rating ?></span>
                    <?php else: ?>
                    <span class="fw-bold"><?= $article->rating ?></span>
                    <?php endif; ?>
                </div>
                <div class="text-muted forum-view-counter ms-3">
                    <svg class="icon download-button-icon mt-n1 me-1">
                        <use xlink:href="<?= asset('icons/sprite.svg') ?>#eye"/>
                    </svg>
                        <?= (int) $article->view_count ?>
                </div>
                <div class="text-muted forum-view-counter ms-3">
                    <svg class="icon download-button-icon me-1">
                        <use xlink:href="<?= asset('icons/sprite.svg') ?>#forum"/>
                    </svg>
                        <?= $article->comments_count ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="mt-3">
                <?= $articles->render() ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info"><?= __('The search didn\'t yield any results.') ?></div>
        <?php endif; ?>
    </div>

@endsection
