
<style>
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
                <div class="col-sm-4 col-md-6 mb-3 mb-sm-0">
                    <h2 class="h4 mb-0 bold">Followers</h2>
                    <span id="follow_count txt-14"><?= $total_f_count ?></span> people who are following you.
                </div>
                <!-- End Title -->


                <!-- Filter -->
                <div class="col-sm-8 col-md-6 text-sm-right">
                    <ul class="list-inline mb-0">

                        <li class="list-inline-item"> </li>

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

            <?= $this->element('account_follow_unfollow', ['following' => false]) ?>
        </div>
    </div>
    <!-- End Content Section -->
</main>
<!-- ========== END MAIN ========== -->



<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Plugins Init. -->