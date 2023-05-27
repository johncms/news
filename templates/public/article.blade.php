<?php

/**
 * @var string $csrf_token
 * @var \Johncms\News\Models\NewsArticle $article
 * @var \Johncms\News\Models\NewsSection $current_section
 */

$tags = [];
if (! empty($article->tags)) {
    foreach ($article->tags as $k => $tag) {
        $tags[] = '<a href="/news/search_tags/?tag=' . urlencode($tag) . '">' . $tag . '</a>';
    }
}

$author = $article->author;

?>
@extends('system::layout/default')

@section('content')

    <div id="blog">
        <div class="p-no-margin overflow-hidden">
            <?= $article->text_safe ?>
        </div>
        <div class="meta text-muted">
            <div class="mt-3"><?= __('Published:') ?> <?= $article->display_date ?></div>
            <?php if($author): ?>
            <div class="mt-1"><?= __('Author:') ?> <a href="<?= $author->profile_url ?>" rel="nofollow"><?= $author->name ?></a></div>
            <?php endif; ?>
            <?php if (! empty($tags)): ?>
            <div class="mt-1"><?= __('Tags:') ?> <?= implode(', ', $tags) ?></div>
            <?php endif; ?>
        </div>

        <div class="article-stat border d-inline-flex align-items-center py-2 px-4 mt-3 border-radius-12">
            <div class="d-flex align-items-center me-4 vue_app">
                <div class="d-flex align-items-center me-2"><?= __('Rating:') ?></div>
                <likes-component
                    :article_id="<?= $article->id ?>"
                    :rating="<?= $article->rating ?>"
                    :can_vote="<?= ($user ? 'true' : 'false') ?>"
                    :voted="<?= $article->current_vote ?>"
                ></likes-component>
            </div>
            <?php if ($article->view_count): ?>
            <div class="d-flex justify-content-end">
                <div class="text-muted forum-view-counter">
                    <svg class="icon download-button-icon mt-n1 me-1">
                        <use xlink:href="<?= asset('icons/sprite.svg') ?>#eye"></use>
                    </svg>
                        <?= $article->view_count ?>
                </div>
            </div>
            <?php endif ?>
        </div>
        <?php
        $messages = [
            'write_comment' => __('Write a comment'),
            'send'          => __('Send'),
            'delete'        => __('Delete'),
            'quote'         => __('Quote'),
            'reply'         => __('Reply'),
            'comments'      => __('Comments'),
            'empty_list'    => __('The list is empty'),
        ];
        if ($locale !== 'en') {
            try {
                echo '<script src="' . asset('ckeditor5/translations/' . $locale . '.js', true) . '"></script>';
            } catch (Exception $exception) {
            }
        }
        ?>
        <script src="<?= asset('ckeditor5/ckeditor.js', true) ?>"></script>
        <div class="vue_app">
            <comments-component
                upload_url="/news/comments/upload_file/"
                :article_id="<?= $article->id ?>"
                :can_write="<?= ($user && empty($user->ban) ? 'true' : 'false') ?>"
                :i18n='<?= json_encode($messages) ?>'
                language="<?= $locale ?>"
                csrf_token="<?= $csrf_token ?>"
            ></comments-component>
        </div>

        <?php if (! $user): ?>
        <div class="d-flex">
            <div class="alert alert-warning">
                    <?= __('You are not logged in. You must be <a href="/login/">logged in</a> to comment.') ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="mt-3">
            <a href="<?= ($current_section !== null ? $current_section->url : '/news/') ?>"><?= __('Back') ?></a>
        </div>
    </div>

@endsection
