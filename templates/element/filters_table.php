<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-striped table-bordered file-export" id="filters_table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Add <br> Edit <br> Description</th>
                    <th>Keyword</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Type</th>
                    <th>Show <br /> On <br /> Business</th>
                    <th>Show <br /> On <br /> Filter</th>
                    <th>Active</th>
                    <!-- <th>Options</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Add <br> Edit <br> Description</th>
                    <th>Keyword</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Type</th>
                    <th>Show <br /> On <br /> Business</th>
                    <th>Show <br /> On <br /> Filter</th>
                    <th>Active</th>
                    <!-- <th>Options</th> -->
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'Filters'), 'specific_id' => 'filters_table', "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'filters'])]) ?>