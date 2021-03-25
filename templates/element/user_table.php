<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-striped table-bordered file-export" id="users_table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Counts</th>
                    <th>Active</th>
                    <!-- <th>Business</th>
                <th>Followers</th>
                <th>Questions</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Counts</th>
                    <th>Active</th>
                    <!-- <th>Business</th>
                <th>Followers</th>
                <th>Questions</th> -->
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'Users'), 'specific_id' => 'users_table', "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'getUsersAjax'])]) ?>