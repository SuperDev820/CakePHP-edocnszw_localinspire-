<?php $this->disableAutoLayout();?>
<?=$this->element('address_form')?>

    <script>
        function getCities2(state_id) {

            if (state_id != "") {
                /*Metronic.blockUI({
                	animate: true,
                	overlayColor: 'none',
                });*/

                $.post(
                    "<?=$this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getLgasDropdown']);?>", {
                        "_csrfToken": "<?=$this->request->getParam('_csrfToken')?>",
                        "state_id": state_id,
                        "lga_id": '<?=!empty($user->lga_id) ? $user->lga_id : (!empty($address->lga_id) ? $address->lga_id : null)?>',
                    }).done(function (response) {
                    $('#lga_div').hide("slow", function () {
                        $('#lga_div').html(response);
                        $('#lga_div').show("slow", function () {


                            // $('.selectpicker').selectpicker('destroy');
                            $('.lga_select').select2({
                                placeholder: 'Select an lga or region',
                                theme: "classic",
                                allowClear: true,
                                // theme: "bootstrap4"
                            });
                            //alert("done");

                        });
                    });
                    //$.unblockUI();
                }).fail(function (e) {
                    console.log(e);
                });
            }
        }

        $(document).ready(function () {
            $('.state_select').on('select2:select', function (e) {
                var data = e.params.data;
                //console.log(data);
                getCities2(data.id);
            });
        });

    </script>
