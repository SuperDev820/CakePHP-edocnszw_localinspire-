<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-striped table-bordered file-export" id="businesses_table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Owner</th>
                    <th>City</th>
                    <th>Sic2</th>
                    <th>Sic4</th>
                    <th>Sic8</th>
                    <th>Reviews</th>
                    <th>Questions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                <th>SN</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Owner</th>
                    <th>City</th>
                    <th>Sic2</th>
                    <th>Sic4</th>
                    <th>Sic8</th>
                    <th>Reviews</th>
                    <th>Questions</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'Businesses'), 'specific_id' => 'businesses_table', "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'businesses'])]) ?>