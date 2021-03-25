function previewImage() {
    // document.getElementById('ad_url').value = $('#ad_image').value;
    var preview = document.querySelector('.preview_image'); //selects the query named img
    var file = document.querySelector('input[id=uploadphoto]').files[0]; //sames as here

    var reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
        //document.getElementById('ad_name').value = file['name'];
    }

    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
        //console.log(reader);
    } else {
        preview.src = "";
    }
}
var modal = new Custombox.modal({
    content: {
    effect: 'fadein',
    target: '#uploadphoto_modal'
    }
});
$('.filedialog_open').click(function(){
    $('#uploadphoto').trigger("click");
    // modal.open();
});
$('.upload_new_pic').click(function(){
    modal.open();
})

function accountImageUpload(){
    var preview = document.querySelector('.profile_image'); //selects the query named img
    if($('input[id=select_photo]').val() == "upload"){
        
        var file = document.querySelector('input[id=uploadphoto]').files[0]; //sames as here
        console.log(file);
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
            //document.getElementById('ad_name').value = file['name'];
        }
    
        if (typeof file != "undefined" && file) {
            reader.readAsDataURL(file); //reads the data as a URL
            //console.log(reader);
        } 
    } else{
        preview.src = $("input[id=profile_withsocial]").val();
        
    } 
        
    Custombox.modal.close();
}

function google_for_profile(){
    gapi.load('client:auth2', {
        callback: function() {
            // Initialize client & auth libraries
            gapi.client.init({
                client_id: '220791968929-0t28vr2jeliutgtnmnbsgja2qt7iajq1.apps.googleusercontent.com',
    			cookiepolicy: 'single_host_origin',
    			scope: 'profile email'
            }).then(
                function(success) {
                },
                function(error) {
                }
            );
        },
        onerror: function() {
            // Failed to load libraries
        }
    });
    gapi.auth2.getAuthInstance().signIn().then(
		function (success) {
			gapi.client.request({
				path: 'https://www.googleapis.com/plus/v1/people/me'
			}).then(
				function (success) {
					// API call is successful

					var user_info = JSON.parse(success.body);
					var image = user_info['image']['url'];
			        var html = '<img data-toggle="tooltip" title="Google" style="height:100px;width:100px;cursor:pointer;" class="img-fluid border rounded-circle google_image social-images-profile" src="'+image+'" alt="Image Description">'
        		    $('.profile_photos').append(html);
        		    $('.google_profile').css('display', 'none');
        		    $('[data-toggle="tooltip"]').tooltip(); 

				},
				function (error) {
					// Error occurred
					console.log(error); //to find the reason
				}
			);
		},
		function (error) {
			// Error occurred
			console.log(error); //to find the reason
		}
	);
}

function twitter_for_profile(){
    var screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
            screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
            outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
            outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
            width = 530,
            height = 470,
            left = parseInt(screenX + ((outerWidth - width) / 2), 10),
            top = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
            features = (
                    'width=' + width +
                    ',height=' + height +
                    ',left=' + left +
                    ',top=' + top
                    );
    newwindow = window.open(base_url + "Account/TwitterLogin?type=profile", 'Login_by_Twitter', features);
    console.log(newwindow);
    if (window.focus) {
        newwindow.focus();
    }
    return false;
}
var twitter_image = "";
function twitter_for_profile2(image){
    console.log("test");
    console.log(image);
    var html = '<img data-toggle="tooltip" title="Twitter" style="height:100px;width:100px;cursor:pointer;" class="img-fluid border rounded-circle twitter_image social-images-profile" src="'+image+'" alt="Image Description">'
    $('.profile_photos').append(html);
    $('.twitter_profile').css('display', 'none');
    $('[data-toggle="tooltip"]').tooltip(); 
}

function fblogin_for_profile() {
	FB.login(function (response) {
		if (response.authResponse) {
		  //  console.log(response);
			// Get and display the user profile data
			getimagefacebook();
		} else {
			document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
		}
	}, {
		scope: 'email'
	});
}

function getimagefacebook() {
// 	if(typeof Custombox != null)Custombox.modal.close();
// Custombox.modal.close();
	FB.api('/me', {
			locale: 'en_US',
			fields: 'id,first_name,last_name,email,link,gender,locale,picture'
		},
		function (response) {
		    var image = response.picture.data.url;
		    var html = '<img data-toggle="tooltip" title="Facebook" style="height:100px;width:100px;cursor:pointer;" class="img-fluid border rounded-circle facebook_image social-images-profile" src="'+image+'" alt="Image Description">'
		    $('.profile_photos').append(html);
		    $('.facebook_profile').css('display', 'none');
		    $('[data-toggle="tooltip"]').tooltip(); 

		});
}
$('.profile_photos').on('click', '.social-images-profile', function(){
    console.log("test");
    $('.profile_photos img').removeClass("selectimage");
    $(this).addClass("selectimage");
    if($(this).hasClass('google_image')){
        $('input[id=profile_withsocial]').val($(this).attr('src'));
	    $('input[id=select_photo]').val("google");
    }else if($(this).hasClass('facebook_image')){
        $('input[id=profile_withsocial]').val($(this).attr('src'));
	    $('input[id=select_photo]').val("facebook");
    }else if($(this).hasClass('twitter_image')){
        $('input[id=profile_withsocial]').val($(this).attr('src'));
	    $('input[id=select_photo]').val("twitter");
    }else if($(this).hasClass('preview_image')){
        $('input[id=profile_withsocial]').val("");
	    $('input[id=select_photo]').val("upload");
    }
})