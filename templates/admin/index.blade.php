<?php

/**
 * @var $title
 * @var $page_title
 * @var $data
 */

?>
@extends('system::layout/default')
@section('content')
    <div class="mobile_tiles">
        <div class="row">
            <div class="col-6 col-sm-4 mt-3 tile">
                <a href="<?= route('news.admin.section') ?>" class="card border text-center">
                    <div class="card-body">
                        <div class="icon_with_badge d-inline-block">
                            <svg class="icon-40">
                                <use xlink:href="<?= asset('icons/sprite.svg') ?>#forum"/>
                            </svg>
                        </div>
                        <div class="mt-2 tile_name"><?= __('Content management') ?></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-sm-4 mt-3 tile">
                <a href="<?= route('news.admin.settings') ?>" class="card border text-center">
                    <div class="card-body">
                        <div class="icon_with_badge d-inline-block">
                            <svg class="icon-40">
                                <use xlink:href="<?= asset('icons/sprite.svg') ?>#settings"/>
                            </svg>
                        </div>
                        <div class="mt-2 tile_name"><?= __('Settings') ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

