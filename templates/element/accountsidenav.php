 <!-- Sidebar Info -->
 <div class="row">
   <div class="col-lg-3 mb-9 mb-lg-0">
     <div class="card  p-3 mb-5">
       <div class="border-bottom pb-1 mb-4">
         <div class="media">
           <div class="u-avatar mr-3">
             <img style="height:100%;width:100%" class="img-fluid border rounded-circle" src="<?= !empty($currentUser) ?  $this->Custom->getDp($currentUser->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">
           </div>
           <div class="media-body">
             <h4 class="h6 mb-1">
               <span class="after_login_name font-weight-semi-bold">
                 <?php if (!empty($currentUser)) :  ?>
                   <?= ucfirst($currentUser->firstname)  ?>
                 <?php else :  ?>
                   User
                 <?php endif;  ?>
               </span>
             </h4>
             <!-- Review -->
             <div class="small mb-4"> <a class="text-primary small" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'account', 'action' => 'settings']); ?>">
                 Edit your profile <br />
               </a> <a class="text-primary small" href="<?= $this->Url->build(['prefix'=>false,'controller' => 'account', 'action' => 'password']); ?>">
                 Change Password
               </a>

             </div>
             <!-- End Review -->
           </div>
         </div>

         <script>
           $(document).ready(function() {
             // connect_with_twitter();
            //  load_connection_data();
            //  social_side_connection();

           })
         </script>

       </div>
       <div class="pb-1" id="social_side_connection">
         <h4 class="font-size-1 font-weight-semi-bold mb-3">Connected accounts</h4>

         <!-- Linked Account -->
         <a class="media align-items-center mb-3" href="javascript:<?= (!$currentUser->is_connect_fb) ? 'fblogin_for_connect();' : 'disconnect_facebook();' ?>">
           <div class="u-sm-avatar mr-3">
             <img class="img-fluid" src="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>assets/img/160x160/img20.png" alt="Image Description">
           </div>
           <div class="media-body">
             <h4 class="font-size-1 text-dark bold mb-0">Facebook</h4>
             <small class="d-block small text-secondary"><?= ($currentUser->is_connect_fb) ? "Disconnect from facebook" : "Connect to facebook" ?></small>
           </div>
         </a>
         <!-- End Linked Account -->
         <!-- Linked Account -->
         <a class="media align-items-center mb-3" href="javascript:<?= (!$currentUser->is_connect_twitter) ? 'twitter_connect();' : 'disconnect_twitter();' ?>">
           <div class="u-sm-avatar mr-3">
             <img class="img-fluid" src="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>assets/img/160x160/img19.png" alt="Image Description">
           </div>
           <div class="media-body">
             <h4 class="font-size-1 text-dark bold mb-0">Twitter</h4>
             <small class="d-block small text-secondary"><?= ($currentUser->is_connect_twitter) ? "Disconnect from twitter" : "Connect to twitter" ?></small>
           </div>
         </a>

         <a class="media align-items-center mb-3" href="javascript:<?= (!$currentUser->is_connect_google) ? 'google_login_for_connect();' : 'disconnect_google();' ?> ">
           <div class="u-sm-avatar mr-3">
             <img class="img-fluid" src="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>assets/img/160x160/img21.png" alt="Image Description">
           </div>
           <div class="media-body">
             <h4 class="font-size-1 text-dark bold mb-0">Google</h4>
             <small class="d-block small text-secondary"><?= ($currentUser->is_connect_google) ? "Disconnect from google" : "Connect to google" ?></small>
           </div>
         </a>
         <!-- End Linked Account -->

       </div>

     </div>
     <h5>Activity</h5>
     <hr>

     <ul class="list-unstyled">
       <li class="small">
         <strong><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>account/activity">Your Activity</a></strong>
         <div>Check out your activity here on localinspire.</div>
       </li><br>
       <li class="small">
         <strong><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>account/reviews">Manage your Reviews</a></strong>
         <div>View, edit, delete and manage all of your reviews.</div>
       </li><br>
       <li class="small">
         <strong><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>account/questions">Questions & Answers</a></strong>
         <div>View and manage your questions, reply to answers and more.</div>
       </li><br>
       <li class="small">
         <strong><a href="<?= $this->Url->build('/', ['fullBase' => true]); ?>account/specials">View all Specials</a></strong>
         <div>View all the specials from businesses in your area and that you have saved.</div>
       </li>
     </ul> <br>


   </div>
   <div class="col-lg-9 mb-9 mb-lg-0">
     <!-- End Sidebar Info -->