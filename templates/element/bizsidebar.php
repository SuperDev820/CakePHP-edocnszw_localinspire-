 <style>
   /* User Cards */
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


 <!-- Sidebar Info -->
 <div class="profile-card-4 ">
   <div class="card">
     <div class="card-body text-center bg-primary rounded-top">
       <div class="user-box">
         <img src="<?= $this->Custom->getBusinessPhotoUrl($active_business) ?>" alt="<?= $active_business->name ?>">
       </div>
       <h5 class="mb-1 text-white">  <a class="" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($active_business->name)), strtolower($active_business->city->name), $active_business->city->state->code, $active_business->id]); ?>"><?php echo $active_business->name; ?></a></h5>
       <h6 class="text-light"><!---<?= $this->Custom->displayCategoriesAndSubcategories($active_business, true) ?>--->
         <?= $active_business->city->name; ?>, <?= strtoupper($active_business->city->state->code); ?> </h6>
     </div>
     <div class="card-body">
       <ul class="list-group shadow-none">
         <li class="list-group-item">
           <div class="list-details pt-1 pb-1">
             <a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'edit', $active_business->id, \Cake\Utility\Text::slug(strtolower($active_business->name))]); ?>"><i class="fas fa-building mr-1"></i> <span>Update business</span></a>
           </div>
         </li>
         <li class="list-group-item">
           <div class="list-details pt-1 pb-1">
             <a href="<?= $this->Url->build(['prefix' => false, 'controller' => "biz", 'action' => 'upgrade']); ?>"><i class="fas fa-shopping-basket mr-1"></i> <span>Listing upgrade</span></a>
           </div>
         </li>

       </ul>
       <div class="row text-center border-bottom mb-2 mt-4">
         <div class="col p-2">
           <h4 class="mb-1 line-height-5"><?= number_format($active_business->review_count) ?></h4>
           <small class="mb-0 font-weight-bold">Reviews</small>
         </div>
         <div class="col p-2">
           <h4 class="mb-1 line-height-5"><?= number_format($active_business->questions_count) ?></h4>
           <small class="mb-0 font-weight-bold">Questions</small>
         </div>
         <div class="col p-2">
           <h4 class="mb-1 line-height-5"><?= number_format($active_business->collection_saves) ?></h4>
           <small class="mb-0 font-weight-bold">Saves</small>
         </div>
       </div>

       <div class=" mt-3">
         <div class="d-block font17 bold mb-1">Localinspire Rating</div>
         <div class="d-block txt-14 mb-1">
           <?= $this->element('stars_count', ['rating' => $active_business->average_rating]) ?>
           <span class="ml-1 "><?= number_format(round($active_business->average_rating), 1) ?></span>
         </div>
       </div>
     </div>
   </div>
 </div>