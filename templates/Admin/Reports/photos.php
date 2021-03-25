<?php $this->assign('title', 'Reported Business Photos'); ?>
<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Reported Business Photos</h4>
                        </div>
                        <div class="col-4 text-right">
                            <!-- <a href="<?= $this->Url->build(['action' => 'add']); ?>" class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New User
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <!-- <p class="card-text">Exporting data from a table can often be a key part of a complex application. The Buttons extension
                            for DataTables provides three plug-ins that provide overlapping functionality for data export.</p> -->
                        <?php echo $this->element('report_photos_table', ['userid' => null, 'showUser' => true, 'ajax' => true, 'show_edit' => false, 'show_remove' => false, "idtouse" => "report_photos_table", "record_name" => "Reported photos", "searching" => false]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- File export table -->