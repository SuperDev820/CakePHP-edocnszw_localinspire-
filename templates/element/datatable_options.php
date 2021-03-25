<script>
    var <?= $specific_id . "_table" ?>;

    jQuery(document).ready(function() {

        if (!$.fn.DataTable.isDataTable("<?= '#' . $specific_id ?>")) {

            <?= $specific_id . "_table" ?> = $("<?= '#' . $specific_id ?>").DataTable({
                // dom: 'Blfrtip',
                //"responsive": true,
                <?php if (isset($ajax_table) && $ajax_table == true) : ?> 
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        'url': "<?= $ajax_url ?>",
                        'data': function(data) {
                            if (typeof selections === 'undefined' || selections === null) {} else {
                                if (selections) {
                                    data.selections = JSON.stringify(selections);
                                }
                            }
                        },
                        "dataSrc": function(json) {
                            //Make your callback here.
                            return json.data;
                        }
                    },
                    "rowCallback": function(row, data) {
                        if (typeof selections === 'undefined' || selections === null) {} else {
                            if (selections.includes($(data[0]).attr('itemid'))) {
                                $(row).addClass('selected');
                                $(row).find('input[type="checkbox"]').prop("checked", true);
                            }
                        }
                    },
                <?php endif; ?>
                <?php if (isset($ordering) && $ordering == false) : ?> "ordering": false,
                <?php endif; ?>
                <?php if (isset($searching) && $searching == false) : ?> "searching": false,
                <?php endif; ?>
                <?php if (isset($paging_and_search) && $paging_and_search == true) : ?> 'select': {
                        'style': 'single'
                    },
                    dom: "<'row'<'col-md-3'f><'col-md-3'B><'col-md-3'>>rt<'row'<'col-md-6'i><'col-md-6'p>>",
                <?php elseif (isset($paging_and_search_multiple) && $paging_and_search_multiple == true) : ?>
                    columnDefs: [{
                        orderable: false,
                        // className: 'select-checkbox',
                        targets: 0,
                        checkboxes: {
                            selectRow: true
                        }
                    }],
                    select: {
                        style: 'multi',
                        // selector: 'td:first-child'
                    },
                    // dom: "<'row'<'col-4'irt><'col-4'B><'col-4'f>>t<'row'<'col-6'><'col-6'>>",
                    // dom: "<'row'<'col-md-3'f><'col-md-3'B><'col-md-3'>>rt<'row'<'col-md-6'i><'col-md-6'p>>",
                    dom: "<'row'<'col-md-3'><'col-md-3'B><'col-md-3'>>rt<'row'<'col-md-3'f><'col-md-6'ip>>",
                    <?php if (isset($pagination) && $pagination == false) : ?> 
                    "paging": false,
                    <?php else : ?>
                     "pagingType": "full_numbers",
                        "paging": true,
                    <?php endif; ?>
                <?php elseif (isset($paging) && $paging == false) : ?>
                    // dom: "<'row'<'col-4'irt><'col-4'B><'col-4'f>>t<'row'<'col-6'><'col-6'>>",
                    dom: "<'row'<'col-md-4'><'col-md-4'B><'col-md-4'f>>rt<'row'<'col-md-6'><'col-md-6'>>",
                <?php else : ?>
                    dom: "<'row'<'col-md-3'lt><'col-md-4'B><'col-md-5'f>>rt<'row'<'col-md-5'i><'col-md-7'p>>",
                <?php endif; ?> 
                "lengthMenu": [5, 10, 25, 50, 75, 100, 200, 500],
                <?php if (isset($export) && $export == false) : ?>
                    buttons: [],
                <?php else : ?>
                    buttons: [
                        // 'copy', 'csv', 'print'
                        'copy', 'csv', 'pdf', 'print'
                        // 'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                <?php endif; ?> "language": {
                    "emptyTable": "Not <?= !empty($record_count) ? $this->Custom->singularise($record_name, $record_count) : '' ?> available at the moment",
                    "decimal": "",
                    <?php if (isset($no_info) && $no_info == true) : ?> "info": "Showing _TOTAL_ <?= $record_name ?>",
                        "infoEmpty": "",
                    <?php else : ?> "info": "Showing _START_ to _END_ of _TOTAL_ <?= $record_name ?>",
                        "infoEmpty": "Showing 0 to 0 of 0 <?= $record_name ?>",
                    <?php endif; ?> "infoFiltered": "(filtered from _MAX_ total <?= !empty($record_count) ? $this->Custom->singularise($record_name, $record_count) : '' ?>)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "select": {
                        rows: {
                            _: " |  Selected %d <?= $record_name ?>",
                            0: "Click on a row to select it",
                            1: "Selected 1 <?= $this->Custom->singularise($record_name, 1) ?>"
                        }
                    },
                    "lengthMenu": "Show _MENU_ <?= $record_name ?>",
                    "loadingRecords": "Loading...",
                    "processing": "Fetching <?= $record_name ?>...",
                    "search": "Search:",
                    "zeroRecords": "No matching <?= !empty($record_count) ? $this->Custom->singularise($record_name, $record_count) : '' ?> records found",
                }
            });



            // jQuery("#sample_1_wrapper");
            // <?= $specific_id . "_table" ?>.find(".group-checkable").change(function() {
            //     var e = jQuery(this).attr("data-set"),
            //         t = jQuery(this).is(":checked");
            //     jQuery(e).each(function() {
            //         t ? ($(this).prop("checked", !0), $(this).parents("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).parents("tr").removeClass("active"));
            //     });
            // });
            // <?= $specific_id . "_table" ?>.on("change", "tbody tr .checkboxes", function() {
            //     $(this).parents("tr").toggleClass("active");
            // });

            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass(
                'btn btn-outline-primary mr-1');



            <?php if (isset($autoreload) && $autoreload == true) : ?>
                //setInterval(function() {
                //<?php //echo $specific_id . "_table" 
                    ?>.ajax.reload(null, false);
                //}, 30000);

            <?php endif; ?>


        }



    });
</script>