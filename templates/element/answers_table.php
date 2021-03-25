<style>
    #<?= $idtouse ?> td:nth-child(2), #<?= $idtouse ?> td:nth-child(3) {
        text-align: left;
    }
</style>
<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="<?= $idtouse ?>">
        <thead>
            <tr>
                <th>SN</th>
                <?php if (isset($showUser) && $showUser == true) : ?>
                    <th>User</th>
                <?php endif; ?>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <?php if (isset($showUser) && $showUser == true) : ?>
                    <th>User</th>
                <?php endif; ?>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ['export' => (isset($export) ? $export : true), 'searching' => (isset($searching) ? $searching : true), 'paging' => (isset($paging) ? $paging : true), "record_name" => $record_name, 'specific_id' => $idtouse, "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'answers', $userid, '?' => ['showuser' => (isset($showUser) && $showUser == true ? 'true' : '')]])]) ?>