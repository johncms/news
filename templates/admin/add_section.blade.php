<?php
/**
 * @var array $data
 * @var string $page_title
 * @var string $csrf_token
 * @var \Johncms\View\MetaTagManager $metaTags
 */

?>
@extends('system::layout/default')

@section('content')

    <?php if (! empty($data['errors'])): ?>
    <div>
        @include('system::app/alert',
            [
                'alert_type' => 'alert-danger',
                'alert'      => $data['errors'],
            ])
    </div>
    <?php endif ?>

    <h4 class="card-title"><?= $metaTags->getPageTitle() ?></h4>
    <form action="<?= $data['action_url'] ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <div class="form-group">
            <label for="title"><?= __('Section name') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="255"
                   name="name"
                   id="title"
                   required
                   value="<?= $data['fields']['name'] ?>"
                   placeholder="<?= __('Section name') ?>"
            >
        </div>
        <div class="form-group">
            <label for="code"><?= __('Section code') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="255"
                   name="code"
                   id="code"
                   value="<?= $data['fields']['code'] ?>"
                   placeholder="<?= __('Section code') ?>"
            >
            <div class="small text-muted"><?= __('Leave it empty for automatic generation') ?></div>
        </div>
        <div class="form-group">
            <label for="keywords"><?= __('Keywords') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="255"
                   name="keywords"
                   id="keywords"
                   value="<?= $data['fields']['keywords'] ?>"
                   placeholder="<?= __('Keywords') ?>"
            >
        </div>
        <div class="form-group">
            <label for="description"><?= __('Description') ?></label>
            <input type="text"
                   class="form-control"
                   maxlength="255"
                   name="description"
                   id="description"
                   value="<?= $data['fields']['description'] ?>"
                   placeholder="<?= __('Description') ?>"
            >
        </div>
        <div class="form-group">
            <label for="text"><?= __('Text after a list') ?></label>
            <textarea id="text" class="form-control" name="text"><?= e($data['fields']['text']) ?></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary"><?= __('Save') ?></button>
            <a href="<?= $data['back_url'] ?>" class="btn btn-outline-primary ms-2"><?= __('Back') ?></a>
        </div>
    </form>
@endsection
