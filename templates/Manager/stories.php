<?php $this->assign('title', 'City Manager'); ?>

<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <!-- Sidebar Info -->
            <div class="row">
                <div class="col-md-3 mb-9 mb-lg-0">
                    <?= $this->element('city_sidebar'); ?>
                </div>
                <!-- End Sidebar Info -->
                <div class="col-md-9 mb-9 mb-lg-0">

                    <div class="card p-5">
                        <!-- Project Title -->
                        <?= $this->element('city_title', ['city_title' => 'City news and stories']) ?>
                        <hr>

                        <div class="row">

                            <!-- <div class="col-6 text-right"> -->
                            <div class="col-6">
                                <a href="<?= $this->Url->build(['action' => 'addStory']); ?>" class="btn round btn-raised btn-dark">
                                    <i class="fa fa-plus"></i>&nbsp; New Post
                                </a>
                            </div>
                            <div class="col-6 text-center">
                                <!-- <fieldset class="form-group">
                                    <label for="status_one">Show by Category</label>
                                    <?= $this->Form->control('category_id', ['templates' => ['inputContainer' => '{{content}}'], 'options' => [], 'empty' => true, 'label' => false, 'class' => 'form-control select2', "id" => 'show_by_cat', "style" => "width: 100%"]); ?>
                                </fieldset> -->
                            </div>
                        </div>
                        <!-- Features Section -->
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive-md">
                                        <table class="js-datatable table table-borderless u-datatable__striped u-datatable__content u-datatable__trigger mb-5" id="posts_table">
                                            <thead>
                                                <tr class="text-uppercase font-size-1">
                                                    <!-- <th>
                                            <input type="checkbox" name="" id="" class="">
                                        </th> -->
                                                    <th>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            #
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            Title
                                                        </div>
                                                    </th>
                                                    <!-- <th>Author</th> -->
                                                    <th>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            Image
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            Tags
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            Actions
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-size-1">

                                            </tbody>
                                        </table>
                                    </div>
                                    <?= $this->element('datatable_options', ["record_name" => (!empty($record_name) ? $record_name : 'blog posts'), 'specific_id' => 'posts_table', "export" => false, "pagination" => true, "checkbox" => false, "ajax_table" => true, "selection" => false, "autoreload" => false, "ajax_url" => $this->Url->build(['prefix' => false, 'controller' => 'AjaxTable', 'action' => 'posts'])]) ?>
                                </div>

                            </div>


                        </div>
                        <!-- End Features Section -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Section -->
    </main>
    <!-- ========== END MAIN ========== -->


</div>
<script>
    $(document).ready(function() {

        // jQuery(document).on('change', '#active_city_select', function(e) {
        //     var city_id = $(this).select2('val');
        //     url = "<?= $this->Url->build(['controller' => 'manager', 'action' => 'switch']); ?>";
        //     url = updateQueryString('city_id', city_id, url);
        //     window.location.href = url;

        // });


    });
</script>