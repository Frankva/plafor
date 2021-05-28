<?php
$update = !is_null($link);
helper('form');
$validation=\CodeIgniter\Config\Services::validation()
?>
<?php
    // For some reasons, you can only set a type to input made with form_input if done with only a array as param, may need to be checked for later uses.

    $data_apprentice = array(
        'name' => 'apprentice',
        'value' => $apprentice_id ?? $apprentice['id'] ?? '',
        'class' => 'form-control',
        'type' => 'hidden',
        'id' => 'apprentice'
    );
?>
<div class="container">
    <!-- TITLE -->
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_apprentice_link_'.($update ? 'update' : 'new')); ?></h1>
        </div>
    </div>
    
    <!-- FORM OPEN -->
    <?php
    $attributes = array(
        'id' => 'apprentice_link_form',
        'name' => 'apprentice_link_form'
    );
    echo form_open('plafor/apprentice/save_apprentice_link/'.$apprentice['id'], $attributes, [
        'id' => $apprentice['id'] ?? 0
    ]);
    ?>

        <!-- ERROR MESSAGES -->
        <?php
        echo count($validation->getErrors())>0?'<div class="alert alert-danger">':null;
        foreach ($validation->getErrors() as $error)
            echo $error;
        echo count($validation->getErrors())>0?'</div>':null;
        ?>
        <!-- USER FIELDS -->
        <div class="row">
            <div class="col-sm-6 form-group">
                <?= form_label(lang('user_lang.field_apprentice_username'), 'apprentice', ['class' => 'form-label']); ?>
                <?= form_input($data_apprentice); ?>
                <p><?=$apprentice['username']?></p>
            </div>
            <div class="col-sm-6 form-group">
                <?= form_label(lang('user_lang.field_trainer_link'), 'trainer', ['class' => 'form-label']); ?>
                <br />
                <?= form_dropdown('trainer',$trainers,$link['id'] ?? '','id="trainer" class="form-control"')?>
            </div>   
        <!-- FORM BUTTONS -->
        <div class="row">
            <div class="col text-right">
                <a class="btn btn-default" href="<?= base_url('plafor/apprentice/list_apprentice'); ?>"><?= lang('common_lang.btn_cancel'); ?></a>
                <?= form_submit('save', lang('common_lang.btn_save'), ['class' => 'btn btn-primary']); ?>
            </div>
        </div>
    <?= form_close(); ?>
</div>
