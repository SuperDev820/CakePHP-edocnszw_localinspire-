<?php $this->disableAutoLayout(); ?>
<div class="l-pre-2 text-left">
    <ul id="location-recent" role="presentation">
        <?php if ($usingRecent) { ?>
            <li class="grey-text txt-14" role="option" data-entity_type="subzone"><a href="javascript:void(0)" onclick="getLocation()" id="get_user_current_location"><i class="fas fa-location-arrow mt-2 mb-2 ml-2 mr-1"></i>
                    Current Location</a></li>
            <li class=" text-left ttupper p-2 text-muted">Recent Locations</li>
            <?php foreach ($result as $citySearch) { ?>
                <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="<?= $citySearch->city->name . ", " . strtoupper($citySearch->city->state->code) ?>"><i class="far fa-clock txt-14 mr-2"></i> <?= $citySearch->city->name . ", " . strtoupper($citySearch->city->state->code) ?></li>
            <?php }  ?>
        <?php } else { ?>
            <li class="grey-text" role="option" data-entity_type="subzone"><a href="javascript:void(0)" onclick="getLocation()" id="get_user_current_location"><i class="fas fa-location-arrow"></i> &nbsp;&nbsp;
                    Use Current Location</a></li>
            <li class=" text-left ttupper p-2 text-muted">Suggested Locations</li>
            <?php foreach ($result as $city) { ?>
                <li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="<?= $city->name . ", " . strtoupper($city->state->code) ?>"><?= $city->name . ", " . strtoupper($city->state->code) ?></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<!--<div class="l-pre-2 text-left">-->
<!--	<ul id="location-popular" role="presentation">-->
<!--		<li class="text-left p-2 ttupper text-muted">Popular-->
<!--			Locations</li>-->
<!--		<li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Terrell-TX">Terrell, TX</li>-->
<!--		<li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Fort-Lauderdale-FL">Fort Lauderdale, FL</li>-->
<!--		<li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="New-York-NY">New York, NY</li>-->
<!--		<li class="item-loc grey-text" role="option" data-entity_type="subzone" data-value="Las-Vegas-NV">Las Vegas, NV</li>-->
<!--	</ul>-->
<!--</div>-->