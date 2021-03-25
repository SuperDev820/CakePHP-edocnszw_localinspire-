<?php for ($i = 0; $i < round($rating); $i++) { ?>
    <li class='list-inline-item mx-0'>
        <span class='fas fa-star text-white star_border'></span>
    </li>
<?php } ?>
<?php if ($rating < 5) { ?>
    <?php for ($i = 0; $i < 5 - round($rating); $i++) { ?>
        <li class='list-inline-item mx-0'>
            <span class='fas fa-star star_border' style='background-color: #ccc;'></span>
        </li>
    <?php } ?>
<?php } ?>