<div class="col-sm-12 mb-5 ">

    <?php foreach ($chunk as $key => $filter) : ?>
        <div class="explore-text filter_<?= str_replace(" ", "", $filter->name) ?> mb-2 filtergrid">
            <div class="mb-2 bold"><?= $filter->name ?></div>
            <?php if ($filter->form_type_id == 3) : /*dropdown*/ ?>
                <?= $this->element('additional_dropdown', ['filter' => $filter, "emptyOption" => true]) ?>
            <?php elseif ($filter->form_type_id == 1) : /*input*/ ?>
                <?= $this->element('additional_input', ['filter' => $filter]) ?>
                <?= $this->element('additional_subcats', ['filter' => $filter, 'searchPage' => true]) ?>
            <?php elseif ($filter->form_type_id == 2) : /*checkbox*/ ?>
                <?= $this->element('additional_subcats', ['filter' => $filter, 'searchPage' => true]) ?>
            <?php elseif ($filter->form_type_id == 5) : /*slider*/ ?>
                <?= $this->element('additional_for_sliders', ['filter' => $filter, 'key' => $key]) ?>
            <?php else : ?>
            <?php endif; ?>

        </div>
        <?php if ($filter->form_type_id == 2 and !empty($filter->subcategories) and count($filter->subcategories) > 3) : ?>
            <!-- <div class="custom-control custom-checkbox"> -->
                <!-- <a class="more_link" href='#' onclick='$("." + "filter_<?= str_replace(" ", "", $filter->name) ?>").addClass("more");$(this).parent().find(".less_link").css("display",  "block");$(this).css("display","none"); return false;'>
                    More...
                </a> -->
                <!-- <a class="more_link" href='#' onclick='$("." + "filter_<?= str_replace(" ", "", $filter->name) ?>").addClass("more");$(this).parent().find(".less_link").css("display",  "block");$(this).css("display","none"); $("." + "filter_<?= str_replace(" ", "", $filter->name) ?>").animate({height: "500"}, 500); return false;'>
                    More...
                </a> -->
                <!-- <a class="less_link" href='#' onclick='$("." + "filter_<?= str_replace(" ", "", $filter->name) ?>").removeClass("more");$(this).parent().find(".more_link").css("display",  "block");$(this).css("display","none"); return false;' style="display:none">
                    Less...
                </a> -->
            <!-- </div> -->
            
        <?php endif; ?>

    <?php endforeach; ?>
</div>
<br>
<br>
<br>