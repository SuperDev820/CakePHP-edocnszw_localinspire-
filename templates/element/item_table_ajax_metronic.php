<table class="table table-striped table-bordered server-side file-export" id="datatable_ajax">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <!-- <th>Category</th> -->
            <th>Price</th>
            <th>Feat'd</th>
            <?php if(isset($showSku) && $showSku == true):?>
            <th>SKU</th>
            <?php endif;?>
            <th>Active</th>
            <!-- <th>Created</th>
            <th>Modified</th>
            <th width="18%">Actions</th> -->
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <!-- <th>Category</th> -->
            <th>Price</th>
            <th>Feat'd</th>
            <?php if(isset($showSku) && $showSku == true):?>
            <th>SKU</th>
            <?php endif;?>
            <th>Active</th>
            <!-- <th>Created</th>
            <th>Modified</th>
            <th>Actions</th> -->
        </tr>
    </tfoot>
</table>
<script src="<?=$this->Url->build('/js/', true);?>datatable.js"></script>
<script>
    var grid = new Datatable();

    var TableAjax = function () {

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
                //rtl: Metronic.isRTL(),
                autoclose: true
            });
        }

        var handleRecords = function () {



            grid.init({
                src: $("#datatable_ajax"),
                onSuccess: function (grid) {
                    // execute some code after table records loaded
                },
                onError: function (grid) {
                    // execute some code on network or other general error
                },
                onDataLoad: function (grid) {
                    // execute some code on ajax data load
                },
                loadingMessage: 'Loading...',
                dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                    // So when dropdowns used the scrollable div should be removed.
                    //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                    "lengthMenu": [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "pageLength": 10, // default record count per page
                    "ajax": {
                        "url": "<?=$this->Url->build(['prefix' => 'Admin', 'controller' => 'Items', 'action' => 'getItemsAjax']);?>", // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ], // set first column as a default sort by asc
                    "columns": [{
                            "orderable": false,
                            "checkbox": 0
                        },
                        {
                            "sn": 1
                        },
                        {
                            "name": 2
                        },
                        {
                            "price": 3
                        },
                        {
                            "featured": 4
                        },
                        {
                            "sku": 5
                        },
                        {
                            "active": 6
                        },
                        // {"orderable": false, "created": 7},
                        // {"orderable": false, "modified": 8},
                        // {
                        //     "orderable": false,
                        //     "actions": 9
                        // }
                    ],
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                e.preventDefault();
                var action = $(".table-group-action-input", grid.getTableWrapper());
                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.setAjaxParam("customActionType", "group_action");
                    grid.setAjaxParam("customActionName", action.val());
                    grid.setAjaxParam("id", grid.getSelectedRows());
                    grid.getDataTable().ajax.reload();
                    grid.clearAjaxParams();
                } else if (action.val() == "") {
                    Metronic.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'Please select an action',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                } else if (grid.getSelectedRowsCount() === 0) {
                    Metronic.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'No record selected',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                }
            });
        }

        return {

            //main function to initiate the module
            init: function () {

                initPickers();
                handleRecords();
            }

        };

    }();

    $(document).ready(function () {
        TableAjax.init();

    });

</script>
