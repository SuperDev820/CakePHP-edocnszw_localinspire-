<script>
    function addSubcategory(data) {

        if (!$.isEmptyObject(data)) {
            // $('.page-loader-wrapper').fadeIn();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'GeneralActions', 'action' => 'addSubcategory']); ?>",
                data: data,
                success: function(response) {
                    console.log(response);
                    hideLoading();
                    if (response.info) {
                        toastr.info(response.message);
                    } else {
                        if (response.success) {
                            toastr.success(response.message);
                            // swal("Good job!", "You added a new subcategory!", "success");
                            var newOption = new Option(response.subcategory.name, response.subcategory.id, true, true);
                            $('#<?= $select_id ?>').append(newOption).trigger('change');
                            // console.log(response);
                        } else {
                            toastr.error(response.message);
                            showAddSubcategory(response);
                            // swal({
                            //     title: "Oops!",
                            //     text: response.message,
                            //     type: "error",
                            //     confirmButtonText: "Ok",
                            // }, function() {
                            //     showAddSubcategory(response);
                            // });
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        }
    }

    function showAddSubcategory(response = {}) { //data is key and model
        var jc = $.confirm({
            //lazyOpen: true,
            type: "dark",
            animation: "scale",
            //icon: '<i class="material-icons">info</i>',
            theme: "modern",
            closeAnimation: "left",
            animateFromElement: false,
            title: 'New Tag',
            content: `<form action="" class="formName"><?php echo $this->element('subcat_form') ?></form>`,
            columnClass: 'col-md-8', //offset-md-4
            buttons: {
                formSubmit: {
                    text: 'Save',
                    btnClass: 'btn-primary',
                    action: function() {
                        var name = this.$content.find('.name').val();
                        var category_id = this.$content.find('.category_id').val();
                        if (!name) {
                            $.alert('Please enter new tag');
                            return false;
                        }
                        if (!category_id) {
                            $.alert('Please choose a category');
                            return false;
                        }
                        var data = {
                            name: name,
                            category_id: category_id,
                        }
                        addSubcategory(data);

                    }
                },
                cancel: function() {
                    //close
                },
            },
            onContentReady: function() {
                if (response) {
                    if (response.data) {
                        this.$content.find('.name').val(response.data.name);
                        this.$content.find('.category_id').val(response.data.category_id);
                    }
                }

                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function(e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });

                //  $(".selectpicker2").selectpicker();



            }
        });


    }

    jQuery(document).ready(function() {

        $('.add_subcat').on('click', function() {
            showAddSubcategory();
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