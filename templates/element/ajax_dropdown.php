<script>
    jQuery(document).ready(function() {


        // $('#select2ajax').on('select2:select', function (e) {
        //     var data = e.params.data;
        //     // console.log(data);
        //     var newOption = new Option(data.name, data.id, true, true);
        //     $('#select2ajax').append(newOption).trigger('change');
        //     $("#add_to_cart_btn").attr("itemid", data.id);

        //     $('.deal_price').val(data.price);  

        // });       

        setTimeout(function() {

            $("#<?= $select_id ?>").select2({
                theme: "classic",
                allowClear: ("<?= isset($allowClear) ? $allowClear : 'false' ?>" == "true"),
                ajax: {
                    // url: "https://api.github.com/search/repositories",
                    url: "<?= $ajax_url ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;


                        return {
                            // results: data.items,
                            results: data.data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: '<?= $ajax_placeholder ?>',
                escapeMarkup: function(markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: <?= isset($minimumInputLength) ? $minimumInputLength : 2 ?>,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            }).on('select2:select', function(e) {
                var data = e.params.data;
                // console.log(data);
                var newOption = new Option(data.name, data.id, true, true);
                $('#<?= $select_id ?>').append(newOption).trigger('change');
                // $("#add_to_cart_btn").attr("itemid", data.id);

                // $('.deal_price').val(data.price);

            });

            <?php if (!empty($default_value)) { ?>
                var newOption = new Option("<?= $default_value['name'] ?>", "<?= $default_value['id'] ?>", true, true);
                $('#<?= $select_id ?>').append(newOption).trigger('change');
            <?php } ?>

            function formatRepo(repo) {

                if (repo.loading) {
                    return repo.text;
                }

                var markup = `<option value="` + repo.id + `">` + repo.name + `</option>`;
                return markup;

                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url +
                    "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

                if (repo.description) {
                    markup += "<div class='select2-result-repository__description'>" + repo.description +
                        "</div>";
                }

                markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo
                    .forks_count + " Forks</div>" +
                    "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " +
                    repo.stargazers_count + " Stars</div>" +
                    "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " +
                    repo.watchers_count + " Watchers</div>" +
                    "</div>" +
                    "</div></div>";

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.full_name || repo.text;
            }




        }, 2000); //



    });
</script>