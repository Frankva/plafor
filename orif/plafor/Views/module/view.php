<?php
/**
 * Modules list view
 *
 * @author      Orif (DeDy)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 *
 */


/**
 * *** Data needed for this view ***
 *
 * @param array $modules List of all the modules. All the fields from the database are needed.
 *
 */



/**
 * No data is sent by this view.
 *
 */

helper('form');

?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="title-section"><?= lang('Grades.modules_catalog') ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="col-sm-12 text-right d-flex justify-content-between">
            <?php if(service('session')->get('user_access')>=config('\User\Config\UserConfig')->access_lvl_admin):?>
                <a href="<?=base_url('plafor/grade/saveTeachingModule')?>" class="btn btn-primary"><?=lang('common_lang.btn_new_m')?></a>
            <?php endif?>
                <span>
                <?=form_label(lang('common_lang.btn_show_disabled'), 'toggle_deleted', ['class' => 'form-check-label','style'=>'padding-right:30px']);?>
                <?=form_checkbox('toggle_deleted', '', isset($with_archived)?$with_archived:false, [
                    'id' => 'toggle_deleted', 'class' => 'form-check-input'
                ]);?>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <?= view('Common\Views\items_list',
        [
            'columns' =>
            [
                'number_module'        => lang('Grades.module_number'),
                'name_module'          => lang('Grades.module_name'),
                'version_module'       => lang('Grades.module_version'),
                'parent_domain_module' => lang('Grades.module_parent_domain'),
            ],
            // TODO : Add data
            // 'items'             => $modules,
            'primary_key_field' => 'id',
            'url_update'        => 'plafor/grade/saveTeachingModule/',
            'url_delete'        => 'plafor/grade/deleteTeachingModule/'
        ])?>
    </div>
</div>