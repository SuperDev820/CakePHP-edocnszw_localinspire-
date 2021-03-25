<div id="addphotoModal" class="js-modal-window u-modal-window" style="width: 820px;">
	<div class="card mb-9">
		<div class="upload_preload">
			<div style="text-align:center; margin-left:50px; margin-bottom:30px;" class="loader  quantum-spinner"></div>
		</div>
		<!-- Header -->
		<header class="card-header bg-light py-3 px-5">
			<div class="d-flex justify-content-between small align-items-center">
				<h3 class="h6 bold mb-0">
					Add photos of&nbsp;<?= ucfirst($business->name) ?>
					<span class="ml-3" style="color:#d9d9d9">|</span>
					<span class="position-relative">
						<a id="tips&guidelines" class="btn btn-sm btn-link btn-bg-transparent" href="javascript:;" role="button" aria-controls="guidelinesDropdown" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#guidelinesDropdown" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
							Tips & guidelines
						</a>

						<div id="guidelinesDropdown" class="dropdown-menu dropdown-unfold p-3 txt-12lt font-weight-normal" aria-labelledby="tips&guidelines" style="min-width: 260px;">
							<h6>All photos must be...</h6>
							<div class="mb-1 txt-12lt"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; Family-friendly</div>
							<div class="mb-1 txt-12lt"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; Original, non-copyrighted images</div>
							<div class="mb-1 txt-12lt"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; Non-commercial</div>
							<div class="mb-1 txt-12lt"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; Virus-free</div>
							<div class="mb-1 txt-12lt"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; In .gif, .jpg, or .png format</div>
							<div class="mb-1 txt-12lt"><i class="fas fa-circle txt-8"></i>&nbsp;&nbsp; No more than 50 photos per upload</div>



						</div>
					</span>
					<!-- End Settings -->
					<br>
					<span class="txt-sm1">
						<i class="fas fa-exclamation-circle mr-1"></i>
						Submission of photos certifies that you are the owner and/or have the right to use and distribute.
					</span>
				</h3>

				<button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
					<span aria-hidden="true">×</span>
				</button>
			</div>
		</header>
		<!-- End Header -->

		<div class="card-body bg-light">
			<?php echo $this->Form->create(null, ['id' => 'photoUpload-form', "name" => "photoUpload", 'class' => 'photoUpload-form js-validate', 'enctype' => 'multipart/form-data'])
			?>
			<!-- <form class="photoUpload-form js-validate" id="photoUpload-form" method="post" name="photoUpload" enctype="multipart/form-data"> -->
			<div style="" class="modal-body text-left <!---photoUpload-body---> ">
				<div class="errorMsg missingDescription" style="display:none;">Please describe all your photos...</div>
				<input type="hidden" name="bid" value="<?= $business->id ?>" />
				<div id="modalphotobody" class="">
					<div class="uploadList" style="display:block" id="uploadList">
					</div>
					<div class="startScreen" id="preuploadtn">
						<div class="inner">
							<div class="fileUpload btn btn-primary br0" style="cursor:pointer;" onclick="addimage();">
								<span>
									<B>Select photos from your computer</B>
								</span>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="inputfiles">
			</div>
			<div class="modal-footer photouploader-footer" style="display:none; justify-content: space-between;">
				<div class="pull-left">
					<button type="button" onClick="addimage();" class="btn btn-soft-facebook btn-smsq bold mb-0">Add
						another Photo</button>
				</div>
				<div class="pull-right">
					<button type="submit" class="btn btn-soft-facebook btn-smsq bold mb-0" name="upload">Upload</button>
				</div>
			</div>
			<?= $this->Form->end() ?>
			<!-- </form> -->
		</div>
	</div>
</div>
<!-- End Photo Modal Window -->
<!-- Report Success Modal Window -->
<div id="businessphotosuccessmodal" class="js-modal-window u-modal-window" style="width: 620px;">
	<div class="card mb-9">
		<!-- Header -->
		<header class="card-header bg-light py-3 px-5">
			<div class="d-flex justify-content-between align-items-center">
				<h3 class="h6 bold mb-0">Business photos uploaded successfully</h3>

				<button type="button" class="close" aria-label="Close" onclick="Custombox.modal.close();">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</header>
		<!-- End Header -->

		<div class="card-body bg-white">

			<!-- Process Section -->
			<div class="container">
				<div class="row">
					<div class="col-md-12 mb-12 mb-md-0">
						<!-- Process -->
						<div class="text-center">
							<div class="position-relative">
								<div id="SVGcircleProcess3" class="svg-preloader min-height-155 mb-2">
									<!-- Icon -->
									<span class="text-primary btn btn-lg btn-icon mt-7">
										<span class="fab fa-whmcs font-size-6 btn-icon__inner btn-icon__inner-bottom-minus"></span>
									</span>
									<!-- End Icon -->

									<!-- SVG Shape -->
									<figure class="w-100 position-absolute top-0 right-0 left-0 z-index-n1">
										<img class="js-svg-injector" src="<?= $this->Url->build('/', ['fullBase' => true]); ?>svg/circle-process-3.svg" alt="Image Description" data-parent="#SVGcircleProcess3">
									</figure>
									<!-- End SVG Shape -->
								</div>

								<h2 class="h4 font-weight-semi-bold text-primary">Thank you!</h2>
								<p class="mb-10">Your photos have been uploaded successfully...</p>
							</div>
							<!-- End Process -->
						</div>
					</div>
					<!-- End Process Section -->
				</div>
			</div>
			<!-- End Report Success Modal Window -->
		</div>
	</div>
</div>

<script>
	var biz_success_modal;

	function addimage() {
		var index = new Date().getTime();
		// console.log(index);
		$('#inputfiles').append('<input type="file" class="upload photouplaoderbtn " id="photo' + index +
			'"  name="photo[]" style="display:none" data-index="' + index + '" />');
		$('input[id=photo' + index + ']').trigger('click');
	}

	function removeimage(index) {
		// console.log(index);
		$('#preview' + index).remove();
		$('input[id=photo' + index + ']').remove();
		$('#uploaded' + index).remove();
		var file_count = $('#inputfiles').find('input');
		// console.log(file_count.length);
		if (file_count.length == 0) {
			$('#photoUpload-form .modal-footer').css('display', 'none');
			$('#uploadList').css('display', 'none');
			$('#preuploadtn').css('display', 'block');
		}
		// console.log($('input[id=photo]')[0].files);
	}


	// var uploadedFiles = [];

	function uploadPhotos() {

		// console.log(uploadedFiles);

		// alert("called uploadPhotos");
		var valid = true;
		var captions = $('#photoUpload-form').find('.inputtxt');
		// console.log(captions);
		for (var i = 0; i < captions.length; i++) {
			if (captions[i].value == "") {
				valid = false;
				break;
			}
		}

		if (!valid) {
			// alert("invlaid");
			$('.errorMsg').css('display', 'block');
			setTimeout(function() {
				$('.errorMsg').css('display', 'none');
			}, 5000);
		} else {
			$('.upload_preload').css('display', 'flex');
			var sendData = [];
			jQuery.each(jQuery('.uploadlistcontainer'), function(i, el) {
				var img = $(this).find('.uploadimg').first().attr('src');
				var caption = $(this).find('.inputtxt').first().val();
				var obj = {
					img: img,
					caption: caption,
				};
				sendData.push(obj);
			});
			$.ajax({
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
					xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
				},
				type: "POST",
				// enctype: 'multipart/form-data',
				url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'uploadPhotos']); ?>",
				data: {
					photos: JSON.stringify(sendData),
					business_id: "<?= $business->id ?>"
				},
				cache: false,
				success: function(response) {
					unblock();
					if (response.success) {
						toastr.success(response.message);
						$('.upload_preload').css('display', 'none');
						Custombox.modal.close();
						biz_success_modal.open();
					} else {
						toastr.error(response.message);
					}
				},
				error: function(error) {
					console.log(error);
					unblock();
					$('.upload_preload').css('display', 'none');
				}
			});

		}
	}


	$(document).ready(function() {
		var count = 0;
		biz_success_modal = new Custombox.modal({
			content: {
				effect: 'fadein',
				target: '#businessphotosuccessmodal'
			}
		});

		// document.getElementsByClassName('upload').addEventListener('change', handleFileSelect, false);
		$("#inputfiles").on('change', 'input[type=file]', function() {
			var index = $(this).data('index');
			var files = $(this)[0].files; //FileList object
			// console.log(files);
			var output = document.getElementById("uploadList");
			var html = "";
			// conso
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				//Only pics
				if (!file.type.match('image')) continue;
				// console.log(file);
				var picReader = new FileReader();
				picReader.onload = function(event) {
					var picFile = event.target;
					// console.log(picFile);
					html += '<div class="uploadlistcontainer container-fluid" id="preview' + index + '">';
					html += '<div class="row image-desc-row" >';
					html += '<input type="hidden" name="listitem_file[]" id="listitem_file_' + index + '" value="1">';
					html += '<div class="col-sm-4 image-part">';
					html += '<img id="pro-img-1" src="' + picFile.result + '" class="uploadimg">';
					html += '</div>';
					html += '<div class="col-sm-8 desc-part">';
					html += '<div class="photoForm mt10">';
					html += '<div class="form-group">';
					html += '<label for="title" class="photouploaderlabel">Photo description (required):</label>';
					html += '<input class="form-control inputtxt" id="caption' + index +
						'"  placeholder="Tell travelers more about your photo." name="caption[]" type="text" aria-label="" data-msg="Please write a description." required>';
					html += '</div></div></div>';
					html += '<div class="removeBtn action"><a href="javascript:removeimage(' + index +
						');" class="remove ui_close_x selFile"><i class="fa fa-times"></i></a>';
					html += '</div>';
					html += '</div>';
					html += '</div>';
					var file_count = $('#inputfiles').find('input');
					if (file_count.length > 0) {
						$('#photoUpload-form .modal-footer').css('display', 'flex');
						$('#uploadList').css('display', 'block');
						$('#preuploadtn').css('display', 'none');
					}
					count++;
					$(output).append(html);
					// $('#inputfiles').append("<input type='text' name='biz_photo[]' value='" +count+  "' style='display:none' />");
				}
				//Read the image
				picReader.readAsDataURL(file);
			}
		})
		// $('#uploadList').on('click', '.remove', function(){
		//     var index = $(this).data('id');
		//     console.log(index);
		// });



		$('#uploadedcontainer').on('click', '.removeuploaded', function() {

		})



		// jQuery(document).on('submit', '#photoUpload-form', function(e) {
		$('#photoUpload-form').submit(function(e) {
			e.preventDefault();

			var valid = true;
			var captions = $('#photoUpload-form').find('.inputtxt');
			// console.log(captions);
			for (var i = 0; i < captions.length; i++) {
				if (captions[i].value == "") {
					valid = false;
					break;
				}
			}

			if (!valid) {
				// alert("invlaid");
				$('.errorMsg').css('display', 'block');
				setTimeout(function() {
					$('.errorMsg').css('display', 'none');
				}, 5000);
				return false;
			}

			if (loggedIn) {
				addPhotosPage();
			} else {
				$('.signuphide').hide();
				$('.loginn').trigger('click');
				addPhotos = true;
			}
		});

	})
</script>