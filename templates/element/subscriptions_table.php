<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="<?= $idtouse ?>">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Business</th>
                <th>Coupon</th>
                <th>Package</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Date</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php if (1 == 2) : ?>
            <tbody>
                <?php $sn = 1;
                foreach ($subscriptions as $subscription) : ?>
                    <?php $snapshot = json_decode($subscription->snapshot) ?>
                    <tr>
                        <td>
                            <?= $sn++ ?>
                        </td>
                        <td>
                            <?php if ($subscription->has('business')) { ?>
                                <a target="_blank" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($subscription->business->name)), $subscription->business->city->state->code, $subscription->business->id]); ?>"><?= $subscription->business->name ?> </a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($subscription->has('package')) { ?>
                                <?= $subscription->package->name ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?= $this->Custom->dateFromTimestamp($subscription->start_timestamp) ?> <br>
                            to <br>
                            <?= $this->Custom->dateFromTimestamp($subscription->end_timestamp) ?> <br>
                            (<?= $subscription->duration ?> days)
                        </td>

                        <td>
                            <?= $currency . number_format($subscription->amount) ?>
                        </td>
                        <td>
                            <?= $currency . number_format($subscription->discount) ?>
                        </td>

                        <td>
                            <?= $this->Time->timeAgoInWords($subscription->created) ?>
                        </td>

                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-search"></i>'), ['prefix' => 'Admin', 'controller' => 'subscriptions', 'action' => 'view', $subscription->id], ['class' => 'btn  btn-xs btn-primary btn-raised btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['prefix' => 'Admin', 'controller' => 'subscriptions', 'action' => 'edit', $subscription->id], ['class' => 'btn btn-xs btn-raised btn-warning btn-icon mr-1 btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fas fa-trash-alt"></i>'), ['prefix' => 'Admin', 'controller' => 'subscriptions', 'action' => 'delete', $subscription->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id), 'class' => 'btn btn-xs btn btn-raised btn-icon btn-danger mr-1 btn-sm', 'escape' => false]) ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
        <tfoot>
            <tr>
                <th>S/N</th>
                <th>Business</th>
                <th>Coupon</th>
                <th>Package</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Date</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
<?php //echo $this->element('datatable_options', ["record_name" => 'orders', "record_count" => count(gettype($subscriptions) == 'object' ? $subscriptions->toArray() : $subscriptions), 'specific_id' => $idtouse]) 
?>
<?php //echo $this->element('datatable_options', ["record_name" => 'orders', "record_count" => count(gettype($subscriptions) == 'object' ? $subscriptions->toArray() : $subscriptions), 'specific_id' => 'order_table', 'ajaxify' => true])
?>
<?php //echo $this->element('datatable_options_ajax', ["record_name" => 'orders', "record_count" => count(gettype($subscriptions) == 'object' ? $subscriptions->toArray() : $subscriptions), 'specific_id' => 'order_table'])
?>
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'subscriptions'), 'specific_id' => $idtouse, "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'subscriptions', (!empty($coupon_id) ? $coupon_id : null), (!empty($package_id) ? $package_id : null), (!empty($business_id) ? $business_id : null)])]) ?>
<script>
    $(document).ready(function() {});
</script>