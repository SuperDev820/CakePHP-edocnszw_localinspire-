<style>
    .user-box {
        width: 110px;
        height: 110px;
        margin: auto;
        margin-bottom: 20px;

    }

    .user-box img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        padding: 3px;
        background: #fff;
        -webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
        -ms-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);

    }
</style>
<div class="profile-card-4">
    <div class="card">
        <div class="card-body text-center bg-primary rounded-top">
            <?php if (!empty($active_city->image)) { ?>
                <div class="user-box">
                    <img src="<?= $this->Custom->getDp($active_city->image, 'cities', '210x100') ?>" alt="<?= $active_city->name ?>">
                </div>
            <?php } else { ?>
                <div style="border-radius:50px" class="user-box pt-5 bg-white">
                    <i class="fas fa-city text-primary fa-5x"></i>
                </div>
            <?php } ?>
            <h5 class="mb-1 text-white"><?= $active_city->name . ', ' . strtoupper($active_city->state->code) ?></h5>
            <h6 class="text-light">City Manager</h6>
        </div>
        <div class="card-body">
            <h5><b>City Overview</b></h5>
            <hr>

            <H6> <b>At a glance</b></H6>

            <DIV class="small">
                <div class="row">
                    <div class="col-md-8">Total income:</div>
                    <div class="col-md-4"><strong>$<?= number_format($total_city_income, 2) ?></strong> </div>
                </div>
                <div class="row">
                    <div class="col-md-8">Business Subscriptions:</div>
                    <div class="col-md-4"><strong><?= number_format($business_subscriptions_count) ?></strong> </div>
                </div>
                <div class="row">
                    <div class="col-md-8">Featured businesses:</div>
                    <div class="col-md-4"><strong><?= number_format($featured_businesses_count) ?></strong> </div>
                </div>

                <P><A href="<?= $this->Url->build(['prefix' => false, 'controller' => "manager", 'action' => 'earnings']); ?>">View Earnings</A></P>
            </DIV>
        </div>
    </div>
</div>