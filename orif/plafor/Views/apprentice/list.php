<?php
/**
 * Users List View
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_apprentice_list'); ?></h1>
        </div>
    </div>
    <div class="row mt-2">
        <table class="table table-hover">
        <thead>
            <tr>
                <th><?= lang('user_lang.field_apprentice_username'); ?></th>
                <th><?= lang('user_lang.field_followed_courses'); ?></th>
            </tr>
        </thead>
        <tbody id="apprenticeslist">
            <?php foreach($apprentices as $apprentice) { ?>
                <tr>
                    <td><a href="<?= base_url('plafor/apprentice/view_apprentice/'.$apprentice['id']); ?>"><?= $apprentice['username']; ?></td>
                    <td><a href="<?= base_url('plafor/admin/list_course_plan/'.$apprentice['id'])?>"><?php
                        $linkedCourses = "";

                            foreach ($courses as $course){
                            $linkedCourses .= ($course['fk_user'] == $apprentice['id']?$coursesList[$course['fk_course_plan']]['official_name'].",":"");
                        } 
                        echo rtrim($linkedCourses,",");
                        ?></a></td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#toggle_deleted').change(e => {
        let checked = e.currentTarget.checked;
        $.post('<?=base_url();?>admin/list_objective/'+(+checked), {}, data => {
            $('#objectiveslist').empty();
            $('#objectiveslist')[0].innerHTML = $(data).find('#objectiveslist')[0].innerHTML;
        });
    });
});
</script>
