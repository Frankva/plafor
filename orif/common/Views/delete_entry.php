<?php
/**
 * Common view for entry deltetion
 *
 * @author      Orif (DeDy)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 *
 */

/**
 * Values needed
 *
 * @param string entry           => The entry being deleted. Required.
 * @param string type            => The type of the entry being deleted. Required.
 * @param string message         => Addidional info about the entry about to be deleted. Optional.
 * @param array linked_entries   => Entries that are linked with the entry being deleted. Required.
 *     [
 *         'type'                => string, required, Type of the linked entry
 *         'name'                => string, required, Name of the linked entry
 *     ],
 * @param string cancel_btn_url  => Url of the cancel button. Required
 * @param array primary_action   => Action we ask a confirmation for. Required.
 *     [
 *         'name'                => string, required, Text of the primary action button
 *         'url'                 => string, required, Url of the primary action button
 *     ],
 * @param array secondary_action => Alternative action to do. Same structure as primary button. Optional.
 *
 * NB : Optional values won't be displayed if they are not provided.
 *
 */

?>

<div id="page-content-wrapper">
    <div class="container">
        <h1><?= lang('plafor_lang.title_delete_entry') ?></h1>

        <p><?= lang('plafor_lang.delete_entry_confirmation') ?></p>

        <div class="alert alert-primary">
            <p class="mb-0">
                <strong>
                    <?= $type ?>
                </strong>
                <br>
                <?= $entry ?>
            </p>
        </div>

        <?php if(isset($linked_entries) && !empty($linked_entries)): ?>
            <div>
                <h2><?= lang('plafor_lang.entries_linked_to_entry_being_deleted') ?></h2>

                <div>
                    <?php foreach($linked_entries as $linked_entry): ?>
                        <p class="alert alert-secondary">
                            <strong>
                                <?= $linked_entry['type'] ?>
                            </strong>
                            <br>
                            <?= $linked_entry['name'] ?>
                        </p>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>

        <?php if(isset($message) && !empty($message)): ?>
            <p class="alert alert-info">
                <?= $message ?>
            </p>
        <?php endif ?>

        <div class="text-right">
            <a class="btn btn-secondary" href="<?= $cancel_btn_url ?>">
                <?= lang('common_lang.btn_cancel'); ?>
            </a>

            <?php if(isset($secondary_action) && !empty($secondary_action)): ?>
                <a class="btn btn-primary" href="<?= $secondary_action['url'] ?>">
                    <?= $secondary_action['name'] ?>
                </a>
            <?php endif ?>

            <a class="btn btn-danger" href="<?= $primary_action['url'] ?>">
                <?= $primary_action['name'] ?>
            </a>

        </div>
    </div>
</div>