<?php $this->assign('title', 'Add photos for ' . ucfirst($business->name)); ?>

<?= $this->element('add_photos_css') ?>
<!-- ========== MAIN CONTENT ========== -->
<main class="gray-dark" id="content" role="main">

	<!-- Add Listing Section -->
	<div class="container pt-5 gray-darkspace-2">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb breadcrumb-no-gutter bg-transparent txt-14">
				<li class="breadcrumb-item bold font18 "><a href="<?= $this->Url->build(['prefix'=>false,'controller' => 'businesses', 'action' => 'view', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id]); ?>"><?= ucfirst($business->name) ?></a></li>
				<li class="breadcrumb-item bold font18 text-gray" aria-current="page">Post Photos</li>
			</ol>
		</nav><!-- Features Section -->
		<div id="SVGelements" class="svg-preloader">
			<!-- SVG Background -->
			<figure class="position-absolute right-0 bottom-0 left-0">
				<img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/wave-1-bottom-sm.svg" alt="Image Description" data-parent="#SVGelements">
			</figure>
			<!-- End SVG Background -->

			<div class="">
				<div class="container space-top-2 space-top-md-3">
					<div class="row align-items-start">
						<div class="col-lg-5 mb-7 mb-lg-0">
							<!-- Title -->
							<div class="pr-md-4 mb-4">

								<h2 class="text-primary">Have a photo of <span class="font-weight-semi-bold"><?= ucfirst($business->name) ?>?</span></h2>
								<p>A picture is worth a thousand words... Paint a picture of this business with any photos you have of it...</p>
							</div>
							<!-- End Title -->

							<button type="button" class="btn btn-primary btn-wide btn-pill bold mr-1 mb-2" data-modal-target="#addphotoModal">Upload your photos</button>
							<div class="row">
								<div class="col-md-12 mt-4">
									<div id="uploadedcontainer" class="mt10">
									</div>
									<img id="rimg" src="" height="50px" width="50px" style="display:none">
								</div>
							</div>

						</div>

						<div class="col-lg-7 mt-auto">
							<!-- SVG Icon -->
							<figure class="ie-app-development">
								<img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/app-development.svg" alt="SVG Illustration" data-parent="#SVGelements">
							</figure>
							<!-- End SVG Icon -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Features Section -->


		<div style="height:100px"></div>
</main>
<?= $this->element('add_photos_modal') ?>