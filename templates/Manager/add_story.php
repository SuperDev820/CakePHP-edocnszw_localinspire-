<?php $this->assign('title', 'Add Story'); ?>

<!-- Content Section -->
<div class="bg-light">
    <main>
        <div class="container space-2">
            <!-- Sidebar Info -->
            <div class="row">
                <!-- End Sidebar Info -->
                <div class="col-md-12 mb-9 mb-lg-0">

                    <div class="card p-5">
                        <!-- Project Title -->
                        <?= $this->element('city_title', ['city_title' => 'Add Story']) ?>
                        <hr>
                        <!-- Features Section -->
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $this->element('posts_form', ['tagoptions' => true, 'empty_tags' => true]) ?>
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