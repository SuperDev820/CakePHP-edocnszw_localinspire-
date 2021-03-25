<?php $this->assign('title', 'Reminders'); ?>
<style>
    /* td {
        text-align: left;
    } */
</style>
<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Businesses Subscription Reminders</h4>
                        </div>
                        <div class="col-4 text-right">
                            <!-- <a href="<?= $this->Url->build(['action' => 'add']); ?>" class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Subscription
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <!-- <p class="card-text">Exporting data from a table can often be a key part of a complex application. The Buttons extension
                            for DataTables provides three plug-ins that provide overlapping functionality for data export.</p> -->
                        <?= $this->element('reminders_table', ['ajax' => true, 'show_edit' => false, 'show_remove' => false, 'idtouse' => 'reminders_table']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- File export table -->