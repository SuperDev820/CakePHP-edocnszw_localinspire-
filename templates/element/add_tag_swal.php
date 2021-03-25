<script>
    function addTag(data) {


        if (!$.isEmptyObject(data)) {
            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'addTag']); ?>",
                data: data,
                success: function(response) {
                    unblock();
                    if (response.error) {
                        swal({
                            title: "Oops!",
                            text: response.message,
                            type: "error",
                            confirmButtonText: "Ok",
                        }, function() {
                            showAddTag(response);
                        });

                    } else {

                        swal("Good job!", "You added a new Tag!", "success");
                        // var newOption = new Option(response.tag.name, response.tag.id, true, true);
                        // $('#<?= $select_id ?>').append(newOption).trigger('change');
                        // console.log(response);
                    }

                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });


        }
    }

    function showAddTag(response = null) {


        var jc = $.confirm({
            //lazyOpen: true,
            type: "dark",
            animation: "scale",
            //icon: '<i class="material-icons">info</i>',
            theme: "modern",
            closeAnimation: "left",
            animateFromElement: false,
            title: 'New Tag',
            content: `<form action="" id="add_cat" class="formName" style="width: 90%;"><div class="form-body row">
        <label class="col-md-3 label-control text-right" for="name"> Name:
            <span class="required" aria-required="true"> * </span>
        </label>
        <div class="col-md-7">
                <?= $this->Form->control('name', ['templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'form-control name', 'placeholder' => 'enter text', 'autocomplete' => 'off', 'required']) ?>
        </div></div></form>`,
            columnClass: 'col-md-8', //offset-md-4
            buttons: {
                formSubmit: {
                    text: 'Save',
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function() {
                        var name = this.$content.find('.name').val();
                        if (!name) {
                            $.alert('Please enter tag name');
                            return false;
                        }
                        var data = {
                            name: name,
                        }
                        addTag(data);
                    }
                },
                cancel: function() {
                    //close
                },
            },
            onContentReady: function() {
                if (response !== undefined) {
                    if (response.data) {
                        this.$content.find('.name').val(response.data.name);
                    }
                }
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function(e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });



    }

    jQuery(document).ready(function() {
        jQuery(document).on('submit', '#add_cat', function(e) {
            e.preventDefault();
        });
        $('.swal').on('click', function() {
            var type = $(this).data('type');
            if (type === 'add-tag') {
                showAddTag();
            }

        });


        // $('.deptselect2').select2({
        //     placeholder: 'Select an option',
        //     theme: "classic",
        //     // theme: "bootstrap4"
        //     language: {
        //         noResults: function (params) {
        //             return "No departments found";
        //         }
        //     }
        // });




    });
</script>