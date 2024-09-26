<?php

/**
 * Lists all course plans.
 *
 * Called by CoursePlan/list_course_plan($id_apprentice, $with_archived)
 *
 * @author      Orif (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (http://www.orif.ch)
 *
 */



/**
 * *** Data needed for this view ***
 *
 * @param array $course_plans List of all course plans.
 * All fields from table.
 *
 * @param bool $with_archived Defines whether to show deleted entries.
 *
 */



/**
 * *** Data sent by this view ***
 *
 * method GET
 *
 * action CoursePlan/list_course_plan($id_apprentice, $with_archived)
 *
 * @param bool $wa Defines whether to show deleted entries.
 *
 */

helper('form');

use CodeIgniter\I18n\Time;

?>

<div class="container">
    <?= view('\Plafor\templates\navigator', ['reset' => true]) ?>

    <!-- Page title -->
    <?= view('\Plafor/common/page_title', ['title' => lang('plafor_lang.title_course_plan_list')]) ?>

    <div class="row mt-2">
        <?php
        $datas = [];

        foreach($course_plans as $course_plan)
        {
            $datas[] =
            [
                'id'         => $course_plan['id'],
                'formNumber' => $course_plan['formation_number'],
                'coursePlan' => $course_plan['official_name'],
                'begin_date' => Time::createFromFormat('Y-m-d', $course_plan['date_begin'])->toLocalizedString('dd.MM.Y'),
                'archive'    => $course_plan['archive']
            ];
        }

        echo view('Common\Views\items_list',
        [
            'items'   => $datas,
            'columns' =>
            [
                'formNumber' => lang('plafor_lang.field_course_plan_formation_number'),
                'coursePlan' => lang('plafor_lang.field_course_plan_official_name'),
                'begin_date' => lang('plafor_lang.field_course_plan_into_effect')
            ],
            'with_deleted'  => true,
            'url_detail'    => 'plafor/courseplan/view_course_plan/',
            'url_create'    => 'plafor/courseplan/save_course_plan',
            'url_update'    => 'plafor/courseplan/save_course_plan/',
            'url_delete'    => 'plafor/courseplan/delete_course_plan/',
            'url_getView'   => 'plafor/courseplan/list_course_plan',
            'url_restore'   => 'plafor/courseplan/delete_course_plan/',
        ]);
        ?>
    </div>
</div>