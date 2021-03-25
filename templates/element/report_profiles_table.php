<div class="table-responsive col-sm-12">
    <table class="table table-striped table-bordered file-export" id="<?= $idtouse ?>">
        <thead>
            <tr>
                <th>SN</th>
                <?php if (isset($showUser) && $showUser == true) : ?>
                    <th>Reported by</th>
                <?php endif; ?>
                <th>Profile</th>
                <th>Details</th>
                <th>Resolved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
                <th>SN</th>
                <?php if (isset($showUser) && $showUser == true) : ?>
                    <th>Reported by</th>
                <?php endif; ?>
                <th>Profile</th>
                <th>Details</th>
                <th>Resolved</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'Reported Profiles'), 'specific_id' => $idtouse, "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'reportedProfiles', (isset($userid) and !empty($userid) ? $userid : ""), '?' => ['showuser' => (isset($showUser) && $showUser == true ? 'true' : '')]])]) ?>