<?php
/**
 * @var array $data
 * @var string $csrf_token
 */

?>
<form action="<?= $data['action_url'] ?>" method="post">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <div class="modal-header align-items-center">
        <h4 class="modal-title">
            <?= __('Confirm the action') ?>
        </h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span class="icon">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <?php if (! empty($data['section'])): ?>
            <div><?= __('Section:') ?> <b><?= $data['section']->name ?></b></div>
        <?php endif; ?>
        <?php if (! empty($data['article'])): ?>
            <div><?= __('Article:') ?> <b><?= $data['article']->name ?></b></div>
        <?php endif; ?>
        <?= __('Do you really want to delete?') ?>
    </div>
    <div class="modal-footer">
        <button type="submit" name="delete" value="1" class="btn btn-danger"><?= __('Delete') ?></button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= __('Cancel') ?></button>
    </div>
</form>
