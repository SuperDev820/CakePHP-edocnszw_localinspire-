 <div class="col-lg-3 card h-25">

 	<div class="card-header pt-4 pb-3 px-0 mx-4">
 		<h2 class="h6 mb-0 bold"> Followers
 			<!--<span style="font-weight:normal;font-size:13px">&bull; 1 in common </span>-->
 		</h2>
 	</div>

 	<div class="card-body pt-3 pb-4 px-4">
 		<div class="followers_list_side">
 			<?php foreach ($followers as $key => $follower) { ?>
 				<!-- User -->
 				<!-- Author -->
 				<a class="" href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'index', $follower->follower->username]); ?>">
 					<div class="media mb-3">
 						<img class="u-avatar rounded-circle mr-3" src="<?= !empty($follower->follower) ?  $this->Custom->getDp($follower->follower->image, 'users', '350x250') : $this->Custom->emptyProfileImage() ?>" alt="Image Description">

 						<div class="media-body align-self-center">
 							<span class="d-block text-dark bold txt-12"><?= ucfirst($follower->follower->firstname) . " " . ucfirst(substr($follower->follower->lastname, 0, 50)) ?></span>
 							<small class="d-block txt-12lt text-graylt"><?= !empty($follower->follower->city) ? $follower->follower->city->name . ", " . strtoupper($follower->follower->city->state->code) : "" ?> </small>
 						</div>


 					</div>
 					<!-- End Author -->
 					<p class="txt-12"><b><?= $follower->follower->followers_count ?></b> <?= $follower->follower->followers_count > 1 ? "followers" : "follower"; ?> &bull; <b> <?= $this->Custom->userContributions($follower->follower) ?></b> contributions </p>
 				</a>
 				<!-- End User -->
 			<?php } ?>
 		</div>
 		<a href="<?= $this->Url->build(['prefix' => false, 'controller' => 'user', 'action' => 'followers', $user->username]); ?>">View more</a>
 	</div>
 </div>
 <!-- End Contacts  -->