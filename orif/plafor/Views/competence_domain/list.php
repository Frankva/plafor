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
  </div>
    <div class="row">
        <div class="col">
            <h1 class="title-section"><?= lang('user_lang.title_competence_domain_list'); ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-left">
            <a href="<?= base_url('admin/save_competence_domain'); ?>" class="btn btn-primary">
                <?= lang('common_lang.btn_new_m'); ?>
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <table class="table table-hover">
        <thead>
            <tr>
                <th><?= lang('user_lang.field_competence_domain_name'); ?></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="competence_domainslist">
            <?php foreach($competence_domains as $competence_domain) { ?>
                <tr>
                    <td><a href="<?= base_url('admin/list_operational_competence/'.$competence_domain['id']); ?>"><span class="font-weight-bold"><?= $competence_domain['symbol']?></span> <?= $competence_domain['name']; ?></td>
                    <td><a href="<?= base_url('apprentice/view_competence_domain/'.$competence_domain['id'])?>"><?= lang('common_lang.btn_details')?></a></td>
                    <td><a href="<?= base_url('admin/save_competence_domain/'.$competence_domain['id']); ?>"><?= lang('common_lang.btn_update')?></a></td>
                    <td><a href="<?= base_url('admin/delete_competence_domain/'.$competence_domain['id']); ?>" class="close">×</td>
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
        $.post('<?=base_url();?>admin/list_competence_domain/'+(+checked), {}, data => {
            $('#competence_domainslist').empty();
            $('#competence_domainslist')[0].innerHTML = $(data).find('#competence_domainslist')[0].innerHTML;
        });
    });
});
</script>
