<style>
    .people-nearby .nearby-user {
        padding: 20px 0;


    }

    img.profile-photo-lg {
        height: 80px;
        width: 80px;
        border-radius: 50%;
    }

    select {
        /*     background-color: blue; */
        background-color: transparent;
        border: none;
        color: black;
        font-size: 13px;


    }
</style>
<main>
    <!-- Content Section -->
    <div class="bg-light">
        <div class="container space-2">

            <?= $this->element('accountsidenav') ?>


            <div class="row justify-content-between align-items-center mb-4">
                <!-- Title -->
                <div class="col-sm-4 col-md-6 mb-3 mb-sm-0  txt-14">
                    <h2 class="h4 mb-0 bold">Following</h2>
                    You're following <span id="follow_count"><?= $total_f_count ?></span> <?= $total_f_count > 1 ? "people" : "person" ?>.
                </div>
                <!-- End Title -->

                <!-- Filter -->
                <div class="col-sm-8 col-md-6 text-sm-right">
                    <ul class="list-inline mb-0">

                        <li class="list-inline-item"></li>

                        <li class="list-inline-item small">
                            Sort by: &nbsp;&nbsp;<select name="filters" class="filters">
                                <option value="a-z" <?= $this->Custom->queryHasKey('sort', 'a-z') ? 'selected="selected"' : '' ?>>Alphabetical A-Z</option>
                                <option value="z-a" <?= $this->Custom->queryHasKey('sort', 'z-a') ? 'selected="selected"' : '' ?>>Alphabetical Z-A</option>
                                <!--<option value="IF">I'm Following</option>-->
                                <option value="recent" <?= $this->Custom->queryHasKey('sort', 'recent') ? 'selected="selected"' : '' ?>>Recently Followed</option>

                            </select>
                        </li>
                    </ul>
                </div>
                <!-- End Filter -->
            </div>

            <?= $this->element('account_follow_unfollow', ['following' => true]) ?>
        </div>
    </div>
    <!-- End Content Section -->
</main>
<!-- ========== END MAIN ========== -->
<script>
    $(document).on('ready', function() {
        // load_following_list("AZ", 0);
        // $('select[name=filters]').change(function(){
        //     var order = $(this).val();
        //     $('.following_list').html("");
        //     $("#view_more_link").data('more', 1);
        //     load_following_list(order, 0);
        // })
    });
</script>