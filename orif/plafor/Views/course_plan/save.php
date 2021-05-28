<?php
$update = !is_null($course_plan);
?>
<?php
helper("form");
$validation=\Config\Services::validation();

// For some reasons, you can only set a type to input made with form_input if done with only a array as param, may need to be checked for later uses.

$data_formation_number = array(
    'name' => 'formation_number',
    'value' => $course_plan_formation_number ?? $course_plan['formation_number'] ?? '',
    'type' => 'number',
    'max' => str_repeat('9',config('\Plafor\Config\PlaforConfig')->FORMATION_NUMBER_MAX_LENGTH),
    'class' => 'form-control',
    'id' => 'course_plan_formation_number'
);

$data_official_name = array(
    'name' => 'official_name',
    'value' => $course_plan_official_name ?? $course_plan['official_name'] ?? '',
    'maxlength' => config('\Plafor\Config\PlaforConfig')->OFFICIAL_NAME_MAX_LENGTH,
    'class' => 'form-control',
    'id' => 'course_plan_official_name'
);

$data_date_begin = array(
    'name' => 'date_begin',
    'value' => $course_plan_date_begin ?? $course_plan['date_begin'] ?? '',
    'type' => 'date',
    'class' => 'form-control', 'id' => 'course_plan_date_begin'
);
?>
<div class="container">
    <!-- TITLE -->
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_course_plan_'.($update ? 'update' : 'new')); ?></h1>
        </div>
    </div>

    <!-- FORM OPEN -->
    <?php
    $attributes = array(
        'id' => 'course_plan_form',
        'name' => 'course_plan_form'
    );
    echo form_open('plafor/admin/save_course_plan', $attributes, [
        'id' => $course_plan->id ?? 0
    ]);
    ?>

    <!-- ERROR MESSAGES -->
    <?php if (! empty($validation->getErrors())) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif ?>

    <!-- USER FIELDS -->
    <div class="row">
        <div class="col-sm-12 form-group">
            <?= form_label(lang('user_lang.field_course_plan_formation_number'), 'course_plan_formation_number', ['class' => 'form-label']); ?>
            <?= form_input($data_formation_number); ?>
            <?= form_label(lang('user_lang.field_course_plan_official_name'), 'course_plan_name', ['class' => 'form-label']); ?>
            <?= form_input($data_official_name); ?>
            <?= form_label(lang('user_lang.field_course_plan_date_begin'), 'course_plan_date_begin', ['class' => 'form-label']); ?>
            <?= form_input($data_date_begin); ?>
        </div>
    </div>

    <!-- FORM BUTTONS -->
    <div class="row">
        <div class="col text-right">
            <a class="btn btn-default" href="<?= base_url('plafor/admin/list_course_plan'); ?>"><?= lang('common_lang.btn_cancel'); ?></a>
            <?= form_submit('save', lang('common_lang.btn_save'), ['class' => 'btn btn-primary']); ?>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<!-- TODO
<script defer>
    document.getElementById()
    function checkPlanNumber(number) {
        let formdata = new FormData();
        formdata.append('course_plan_formation_number',number);
        fetch('<?=base_url("plafor/admin/save_course_plan")?>', {
            method: 'POST',
            body:
        })
    }
    
    
*/
</script>
-->