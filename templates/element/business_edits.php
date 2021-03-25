<style>
    td:nth-child(4) {
        text-align: left;
    }

    .new_value {
        text-decoration: none;
        background-color: #d4fcbc;
    }

    .del {
        text-decoration: line-through;
        background-color: #fbb6c2;
        color: #555;
    }
</style>
<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-striped table-bordered file-export" id="businesses_table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Business</th>
                    <th>User</th>
                    <th>Changes</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Business</th>
                    <th>User</th>
                    <th>Changes</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'Edit requests'), 'specific_id' => 'businesses_table', "ajax_table" => true, "export" => false, "searching" => false, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'businessesEdits'])]) ?>