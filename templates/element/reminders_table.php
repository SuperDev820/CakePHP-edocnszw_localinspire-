<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="<?= $idtouse ?>">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Business</th>
                <th>Number of Times</th>
                <th>Status</th>
                <th>Schedule</th>
                <th>Send Count</th>
                <th>Active</th>
                <th>Access</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>S/N</th>
                <th>Business</th>
                <th>Number of Times</th>
                <th>Status</th>
                <th>Schedule</th>
                <th>Send Count</th>
                <th>Active</th>
                <th>Access</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'reminders'), 'specific_id' => $idtouse, "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'reminders'])]) ?>
<script>
    $(document).ready(function() {});
</script>