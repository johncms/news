<?php

/**
 * @var $title
 * @var $page_title
 * @var array $data
 */


/** @var \Johncms\News\Models\NewsSection $sections */
$sections = $data['sections'];

/** @var \Illuminate\Pagination\LengthAwarePaginator $articles */
$articles = $data['articles'];

?>
@extends('system::layout/default')
@section('content')

    <?php if ($data['messages']): ?>
    <div>
         @include('system::app/alert',
            [
                'alert_type' => 'alert-success',
                'alert'      => e($data['messages']),
            ])
    </div>
    <?php endif ?>

    <div class="mb-3">
        <a href="/admin/news/add_article/<?= $data['current_section'] ?>" class="btn btn-primary"><?= __('Add article') ?></a>
        <a href="/admin/news/add_section/<?= $data['current_section'] ?>" class="btn btn-primary"><?= __('Add section') ?></a>
    </div>

    <table class="table table-bordered responsive-table">
        <thead>
        <tr>
            <th scope="col" style="width: 58px;" class="border-end-0"></th>
            <th scope="col" class="border-start-0">#</th>
            <th scope="col"><?= __('Name') ?></th>
            <th scope="col"><?= __('Code') ?></th>
            <th scope="col"><?= __('Type') ?></th>
            <th scope="col" style="width: 170px;"><?= __('Created at') ?></th>
            <th scope="col" style="width: 170px;"><?= __('Updated at') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($sections->count() > 0 || $articles->count() > 0): ?>
            <?php foreach ($sections as $section): ?>
            <!-- List of sections -->
            <?php /** @var \Johncms\News\Models\NewsSection $section */ ?>
        <tr>
            <th scope="row" style="width: 58px;" class="border-end-0">
                <div class="dropdown">
                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="menu-icon">
                            <use xlink:href="<?= asset('icons/sprite.svg') ?>#menu"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/news/edit_section/<?= $section->id ?>/"><?= __('Edit') ?></a>
                        <a class="dropdown-item" data-url="/admin/news/del_section/<?= $section->id ?>/" data-bs-toggle="modal" data-bs-target=".ajax_modal"><?= __('Delete') ?></a>
                    </div>
                </div>
            </th>
            <th scope="row" class="border-start-0">
                <a href="/admin/news/content/<?= $section->id ?>/"><?= $section->id ?></a>
            </th>
            <th scope="row"><a href="/admin/news/content/<?= $section->id ?>/"><?= $section->name ?></a></th>
            <td data-title="<?= __('Code') ?>"><a href="/admin/news/content/<?= $section->id ?>/"><?= $section->code ?></a></td>
            <td data-title="<?= __('Type') ?>"><?= __('Section') ?></td>
            <td data-title="<?= __('Created at') ?>"><?= $section->created_at ?></td>
            <td data-title="<?= __('Updated at') ?>"><?= $section->updated_at ?></td>
        </tr>
        <?php endforeach; ?>
            <?php foreach ($articles as $article): ?>
            <!-- List of articles -->
            <?php /** @var \Johncms\News\Models\NewsArticle $article */ ?>
        <tr>
            <th scope="row" style="width: 40px;" class="border-end-0">
                <div class="dropdown">
                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="menu-icon">
                            <use xlink:href="<?= asset('icons/sprite.svg') ?>#menu"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/news/edit_article/<?= $article->id ?>/"><?= __('Edit') ?></a>
                        <a class="dropdown-item" data-url="/admin/news/del_article/<?= $article->id ?>/" data-bs-toggle="modal" data-bs-target=".ajax_modal"><?= __('Delete') ?></a>
                    </div>
                </div>
            </th>
            <th scope="row" class="border-start-0"><a href="/admin/news//edit_article/<?= $article->id ?>/"><?= $article->id ?></a></th>
            <td data-title="<?= __('Name') ?>"><a href="/admin/news/edit_article/<?= $article->id ?>/"><?= $article->name ?></a></td>
            <td data-title="<?= __('Code') ?>"><a href="/admin/news/edit_article/<?= $article->id ?>/"><?= $article->code ?></a></td>
            <td data-title="<?= __('Type') ?>"><?= __('Article') ?></td>
            <td data-title="<?= __('Created at') ?>"><?= $article->created_at ?></td>
            <td data-title="<?= __('Updated at') ?>"><?= $article->updated_at ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="7" class="text-center fw-bold"><?= __('The list is empty') ?></td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?= $articles->render() ?>

@endsection
