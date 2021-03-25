

<table id="table" class="table table-bordered table-striped table-condensed" data-toggle="table" data-url="<?=$this->Url->build(['prefix' => 'Admin', 'controller' => 'Items', 'action' => 'getItemsBsTable']);?>"
    data-pagination="true" data-side-pagination="server" data-page-list="[5,10, 20, 50, 100, 200]" data-search="true"
    data-show-export="true" data-unique-id="id" data-show-refresh="true">
    <!-- data-height="auto" data-ajax="ajaxRequest"   data-cookie="true" data-cookie-id-table="saveId" data-show-columns="true" data-search="true"  data-detail-view="true" data-height="auto"-->
    <thead> 
        <tr>
            <th data-field="sn" data-sortable="true" export="false">S/N</th>
            <th data-field="name" data-sortable="true" data-align="center">Name</th>
            <!-- <th>Category</th> -->
            <th data-field="price" data-sortable="true" data-align="center">Price</th>
            <th data-field="featured" data-sortable="true" data-align="center">Feat'd</th>
            <?php if(isset($showSku) && $showSku == true):?>
            <th data-field="sku" data-sortable="false" data-align="center">SKU</th>
            <?php endif;?>
            <th data-field="active" data-sortable="true" data-align="center">Active</th>
            <th data-field="Items.created" data-sortable="true" data-align="center">Created</th>
            <th data-field="Items.modified" data-sortable="true" data-align="center">Modified</th>
            <th data-field="action" data-sortable="true" data-align="center" width="18%">
                <?=__('Action')?>
            </th>


        </tr>
    </thead>
    <tbody class="main_tbody">
    </tbody>
</table>


    <div class="clearfix"></div>
    <!-- END PAGE BASE CONTENT -->
    <script>
        $(document).ready(function () {

            $('#table').bootstrapTable({
                showExport: true,
                exportOptions: {
                    fileName: 'items',
                    // ignoreColumn: [0, 14]
                },
                formatNoMatches: function () {
                    return 'No items found';
                },
                //minimumCountColumns: 30,
                //  sortable: true,
                //striped: true,
                //iconsPrefix: 'glyphicon',
                //pageNumber: 1,
                pageSize: 10,
                //showHeader: false,
                //showRefresh: true,
                //showToggle: true,
                classes: 'table table-striped table-bordered table-hover',
                showExport: true,
                showColumns: true,
                //rememberOrder: true,
                //pageList: [5, 10, 25, 50, 100, 200],
                showPaginationSwitch: true,
                search: true,
                pagination: true,
                formatDetailPagination: function (totalRows) {
                    return 'Showing ' + totalRows + ' items';
                },
                formatShowingRows: function (pageFrom, pageTo, totalRows) {
                    return 'Showing ' + pageFrom + ' to ' + pageTo + ' of ' + totalRows +
                        ' items';
                },
                formatRecordsPerPage: function (pageNumber) {
                    return pageNumber + ' items per page';
                }
            });


        });

    </script>
