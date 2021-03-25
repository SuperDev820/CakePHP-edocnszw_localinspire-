<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="users_table">
        <thead>
            <tr>
                <th>SN</th>
                <th>Unique ID</th>
                <th>IP</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Unique ID</th>
                <th>IP</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => "saved visitors", 'specific_id' => 'users_table', "ajax_table" => true, "autoreload" => false, "ordering" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'getSavedVisitors'])]) ?>