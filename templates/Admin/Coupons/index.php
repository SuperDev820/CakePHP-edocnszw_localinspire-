<?php $this->assign('title', 'Coupons'); ?>
<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Coupons</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="<?= $this->Url->build(['action' => 'add']); ?>" class="btn round btn-raised btn-dark">
                                <i class="fa fa-plus"></i>&nbsp; New Coupon
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <!-- <p class="card-text">Exporting data from a table can often be a key part of a complex application. The Buttons extension
                            for DataTables provides three plug-ins that provide overlapping functionality for data export.</p> -->

                        <table class="table table-striped table-bordered file-export" id="coupons_table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Code</th>
                                    <th>User</th>
                                    <th>Active</th>
                                    <th>Expiration</th>
                                    <th>Amount</th>
                                    <th>Percent</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sn = 1;
                                foreach ($coupons as $coupon) : ?>
                                    <tr>
                                        <td>
                                            <?= $sn++ ?>
                                        </td>
                                        <td>
                                            <?= h($coupon->code) ?>
                                        </td>
                                        <td>
                                            <?php if ($coupon->has('user')) { ?>
                                                <a target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $coupon->user->username]); ?>"><?= $coupon->user->name_desc ?> </a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?= $coupon->active ? "Yes" : "No" ?>
                                        </td>
                                        <td>
                                            <?= $coupon->expiration ?>
                                        </td>
                                        <td>
                                            <?php if ($coupon->percentage_voucher) : ?>
                                                N/A
                                            <?php else : ?>

                                                <?= $currency . number_format($coupon->amount) ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($coupon->percentage_voucher) : ?>
                                                <?= number_format($coupon->percent) ?>%
                                            <?php else : ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?= $this->Time->timeAgoInWords($coupon->created) ?>
                                        </td>
                                        <td>
                                            <?= $this->Time->timeAgoInWords($coupon->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('<i class="fa fa-search"></i>'), ['action' => 'view', $coupon->id], ['class' => 'btn btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $coupon->id], ['class' => 'btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                                            <?= $this->Form->postLink(__('<i class="fas fa-trash-alt"></i>'), ['action' => 'delete', $coupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coupon->id), 'class' => 'btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm', 'escape' => false]) ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Code</th>
                                    <th>User</th>
                                    <th>Active</th>
                                    <th>Expiration</th>
                                    <th>Amount</th>
                                    <th>Percent</th>
                                    <th>Created</th>
                                    <th>Modified</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- File export table -->
<!-- <script src="<?= $this->Url->build('/backend/', ['fullBase' => true]); ?>app-assets/js/data-tables/datatable-advanced.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => 'Coupons', 'specific_id' => "coupons_table", "record_count" => count($coupons)]) ?>
<script>
    $(document).ready(function() {




    });
</script>