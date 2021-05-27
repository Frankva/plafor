<?php
helper('form');
$validation= \CodeIgniter\Config\Services::validation();
?>
<div class="container">
    <!-- TITLE -->
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_edit_acquisition_status'); ?></h1>
        </div>
    </div>

    <!-- FORM OPEN -->
    <?php
    $attributes = array(
        'id' => 'edit_acquisition_status',
        'name' => 'edit_acquisition_status'
    );
    echo form_open('plafor/apprentice/save_acquisition_status/'.$id, $attributes);
	?>

		<!-- ERROR MESSAGES -->
		<?php
        echo count($validation->getErrors())>0?'<div class="alert alert-danger">':null;
        foreach ($validation->getErrors() as $error) {
            echo $error;
        }
        echo count($validation->getErrors())>0?'</div>':null; ?>

		<!-- FIELDS -->
		<div class="row form-group">
			<div class="col-6">
				<?= lang('user_lang.field_acquisition_level', ['class'=>'form-label']); ?>
			</div>
			<div class="col-6">
				<?= form_dropdown('field_acquisition_level',['id' => 'field_acquisition_level', 'class' => 'form-control'], $acquisition_level, ); ?>
			</div>
		</div>

        <!-- FORM BUTTONS -->
        <div class="row">
            <div class="col text-right">
                <a class="btn btn-default" href="<?= base_url('plafor/apprentice/view_acquisition_status/'.$id); ?>"><?= lang('common_lang.btn_cancel'); ?></a>
                <?= form_submit('save', lang('common_lang.btn_save'), ['class' => 'btn btn-primary']); ?>
            </div>
        </div>
	<?= form_close(); ?>
</div>
