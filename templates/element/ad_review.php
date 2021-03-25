<?php if (!empty($review)) { ?>

    
    <a class="bold txt-14" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $review->user->username]); ?>" target="_blank">
          <?= $review->user->name_desc ?></a> <span class="bold txt-14">said</span>
        
        <small>"<?= $this->Custom->truncate($review->comment, 250, true) ?>" </small>
    

<?php } else { ?>
  
        <p class="pr-2 pl-2 pt-1"><?= !empty($description) ? $description : $business->description ?></p>
    
    <!-- <div class="col-md-3" style="padding-right: 0;">
        <img class="u-avatar rounded-circle float-right" src="<?= $this->Custom->emptyProfileImage() ?>" alt="Image Description" style="max-width:50px;">
    </div>
    <div class="col-md-9">
        <a class="bold text-dark" href="#" target="_blank">
            <h5 class="mb-0">John Doe</h5>
        </a>
        <small><?= $business->description ?></small>
    </div> -->
<?php } ?>  </div>
        </div>
    </div>
</div>