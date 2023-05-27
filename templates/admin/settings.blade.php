<?php

/**
 * This file is part of JohnCMS Content Management System.
 *
 * @copyright JohnCMS Community
 * @license   https://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link      https://johncms.com JohnCMS Project
 */

?>

@extends('system::layout/default')
@section('content')

    <?php if (! empty($data['message'])): ?>
        @include('system::app/alert',
            [
                'alert_type' => 'alert-success',
                'alert'      => e($data['message']),
            ])
    <?php endif; ?>
    <form action="<?= $data['form_action'] ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <h4 class="mt-3 fw-bold"><?= __('Home page settings') ?></h4>

        <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" class="form-check-input" name="homepage_show" value="1"
                   id="homepage_show" <?= $data['current_settings']['homepage_show'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="homepage_show"><?= __('Show on home page') ?></label>
        </div>

        <div class="form-group">
            <label for="homepage_quantity"><?= __('Quantity of news') ?></label>
            <input type="text" name="homepage_quantity" class="form-control" id="homepage_quantity" value="<?= $data['current_settings']['homepage_quantity'] ?>">
        </div>
        <div class="form-group">
            <label for="homepage_days"><?= __('How many days to show?') ?></label>
            <input type="text" name="homepage_days" class="form-control" id="homepage_days" value="<?= $data['current_settings']['homepage_days'] ?>">
            <div class="text-muted small"><?= __('0 - always display.') ?></div>
        </div>

        <h4 class="mt-3 fw-bold"><?= __('Meta tags for the main page') ?></h4>
        <div class="form-group">
            <label for="title"><?= __('Module name') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="250"
                   name="title"
                   id="title"
                   value="<?= e($data['current_settings']['title']) ?>"
                   placeholder="<?= __('Module name') ?>"
            >
        </div>
        <div class="form-group">
            <label for="meta_keywords"><?= __('Keywords') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="500"
                   name="meta_keywords"
                   id="meta_keywords"
                   value="<?= e($data['current_settings']['meta_keywords']) ?>"
                   placeholder="<?= __('Keywords') ?>"
            >
        </div>
        <div class="form-group">
            <label for="meta_description"><?= __('Description') ?></label>
            <textarea id="meta_description" class="form-control" name="meta_description"><?= e($data['current_settings']['meta_description']) ?></textarea>
        </div>

        <h4 class="mt-3 fw-bold"><?= __('Meta tag templates for sections') ?></h4>
        <div class="form-group">
            <label for="section_title"><?= __('Title') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="250"
                   name="section_title"
                   id="section_title"
                   value="<?= e($data['current_settings']['section_title']) ?>"
                   placeholder="<?= __('Title') ?>"
            >
        </div>
        <div class="form-group">
            <label for="section_meta_keywords"><?= __('Keywords') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="500"
                   name="section_meta_keywords"
                   id="section_meta_keywords"
                   value="<?= e($data['current_settings']['section_meta_keywords']) ?>"
                   placeholder="<?= __('Keywords') ?>"
            >
        </div>
        <div class="form-group">
            <label for="section_meta_description"><?= __('Description') ?></label>
            <textarea id="section_meta_description"
                      class="form-control"
                      name="section_meta_description"><?= e($data['current_settings']['section_meta_description']) ?></textarea>
        </div>

        <h4 class="mt-3 fw-bold"><?= __('Meta tag templates for articles') ?></h4>
        <div class="form-group">
            <label for="article_title"><?= __('Title') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="250"
                   name="article_title"
                   id="article_title"
                   value="<?= e($data['current_settings']['article_title']) ?>"
                   placeholder="<?= __('Title') ?>"
            >
        </div>
        <div class="form-group">
            <label for="article_meta_keywords"><?= __('Keywords') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="500"
                   name="article_meta_keywords"
                   id="article_meta_keywords"
                   value="<?= e($data['current_settings']['article_meta_keywords']) ?>"
                   placeholder="<?= __('Keywords') ?>"
            >
        </div>
        <div class="form-group">
            <label for="article_meta_description"><?= __('Description') ?></label>
            <textarea id="article_meta_description"
                      class="form-control"
                      name="article_meta_description"><?= e($data['current_settings']['article_meta_description']) ?></textarea>
        </div>

        <div class="d-flex flex-wrap justify-content-between">
            <div class="mb-1 me-1">
                <input type="submit" name="submit" value="<?= __('Save') ?>" class="btn btn-primary"/>
                <a href="<?= $data['back_url'] ?>" class="btn btn-secondary"><?= __('Cancel') ?></a>
            </div>
        </div>
    </form>
@endsection
