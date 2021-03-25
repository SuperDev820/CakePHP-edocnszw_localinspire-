<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="<?= $idtouse ?>">
        <thead>
            <tr>
                <th>S/N</th>
                <th>User</th>
                <th>Cities</th>
                <th>Transaction ID</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Paid</th>
                <th>Date</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>S/N</th>
                <th>User</th>
                <th>Cities</th>
                <th>Transaction ID</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Paid</th>
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
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'city subscriptions'), 'specific_id' => $idtouse, "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'citysubscriptions'])]) ?>
<script>
    $(document).ready(function() {});
</script>