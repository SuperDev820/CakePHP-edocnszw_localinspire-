<style>
    table {
        width: 100% !important;
    }

    thead {
        display: none;
    }

    td {
        text-align: left;
    }
</style>

<div class="table-responsive col-md-12">
    <table class="table table-striped table-bordered file-export" id="<?= $idtouse ?>">
        <thead>
            <tr>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- END PAGE LEVEL JS-->
<?= $this->element('datatable_options', ['export' => (isset($export) ? $export : true), 'searching' => (isset($searching) ? $searching : false), 'paging_and_search' => (isset($paging_and_search) ? $paging_and_search : true), "export" => false, "record_name" => $record_name, 'specific_id' => $idtouse, "ajax_table" => true, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'reviews', (isset($userid) ? $userid : ''), '?' => ['business_id' => (isset($business_id) ? $business_id : ''), 'mini' => true, 'showuser' => (isset($showUser) && $showUser == true ? 'true' : '')]])]) ?>