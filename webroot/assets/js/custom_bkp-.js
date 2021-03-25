var pathname = window.location.pathname; // Returns path only (/path/example.html)
var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
var origin   = window.location.origin; 
//alert(url+"/User_authentication/chk_login");
 function userLogin()
   {
        var Email=$('#EmailSidebar').val();
        var Password=$('#PasswordSidebar').val();
       
         $.ajax({
                url: url+"User_authentication/chk_login",
                data:{Email: Email,Password:Password},
                method:"post",
                dataType : "json",
                success: function(data){
                  var eID= data.Member_ID;    
                  if(data.status=="true"){
                   Custombox.modal.close();
                  $("#showImg").attr("src",data.Profile);
                  $("#spanname").text(data.FirstName);
                  $(".after_login_img").attr("src",data.Profile);
                  $(".after_login_name").text(data.FirstName+' '+data.LastName);
                  $('#sessionid').val(eID);
                  $('.after_login').css({'display':'block'});
                  $('.after_login_view_profile').css({'display':'block'});
                  $('.before_login').css({'display':'none'});
                  }
                  else {
                      $("#error").html(data.msg); 
                  }
                }
            });
   }
  
    $(window).on('load', function () {
      $('.js-mega-menu').SRMegaMenu({
        event: 'hover',
        pageContainer: $('.container'),
        breakpoint: 767.98,
        hideTimeOut: 0
      });
      $('.js-breadcrumb-menu').SRMegaMenu({
        event: 'hover',
        pageContainer: $('.container'),
        breakpoint: 991.98,
        hideTimeOut: 0
      });

      // initialization of svg injector module
      $.SRCore.components.SRSVGIngector.init('.js-svg-injector');
    });

    $(document).on('ready', function () {
      // initialization of header
      $.SRCore.components.SRHeader.init($('#header'));

      // initialization of unfold component
      $.SRCore.components.SRUnfold.init($('[data-unfold-target]'), {
        afterOpen: function () {
          $(this).find('input[type="search"]').focus();
        }
      });

        // initialization of malihu scrollbar
        $.SRCore.components.SRMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of forms
        $.SRCore.components.SRFocusState.init();

        // initialization of form validation
        $.SRCore.components.SRValidation.init('.js-validate');

        // initialization of autonomous popups
        $.SRCore.components.SRModalWindow.init('[data-modal-target]', '.js-modal-window', {
        autonomous: true
        });

        // initialization of step form
        $.SRCore.components.SRStepForm.init('.js-step-form');

        // initialization of show animations
        $.SRCore.components.SRShowAnimation.init('.js-animation-link');

        // initialization of range datepicker
        $.SRCore.components.SRRangeDatepicker.init('.js-range-datepicker');

        // initialization of chart pies
        var items = $.SRCore.components.SRChartPie.init('.js-pie');

        // initialization of fancybox
        $.SRCore.components.SRFancyBox.init('.js-fancybox');

        // initialization of forms
        $.SRCore.components.SRRangeSlider.init('.js-range-slider');

        // initialization of slick carousel
        $.SRCore.components.SRSlickCarousel.init('.js-slick-carousel');

        // initialization of datatables
       // $.SRCore.components.SRDatatables.init('.js-datatable');

        // initialization of select picker
        $.SRCore.components.SRSelectPicker.init('.js-select');


        // initialization of horizontal progress bars
        var horizontalProgressBars = $.SRCore.components.SRProgressBar.init('.js-hr-progress', {
        direction: 'horizontal',
        indicatorSelector: '.js-hr-progress-bar'
        });

        var verticalProgressBars = $.SRCore.components.SRProgressBar.init('.js-vr-progress', {
        direction: 'vertical',
        indicatorSelector: '.js-vr-progress-bar'
        });

        // initialization of go to
        $.SRCore.components.SRGoTo.init('.js-go-to');

        // initialization of animation
        //$.SRCore.components.SROnScrollAnimation.init('[data-animation]');

        // initialization of scroll effect component
        $.SRCore.components.SRScrollEffect.init('.js-scroll-effect');
    });
    $(window).on('load', function () {
        
      $.SRCore.components.SRScrollNav.init($('.js-scroll-nav'), {
        duration: 700,
        customOffsetTop: 77
      });
      var offsetTop = $('#logoAndNav').outerHeight();
    });
    function SRSwitchTab(sr_tab_id, sr_tab_content) {
      // first of all we get all tab content blocks (I think the best way to get them by class names)
      var x = document.getElementsByClassName("tabcontent");
      var i;
      for (i = 0; i < x.length; i++) {
         x[i].style.display = 'none'; // hide all tab content
      }
      document.getElementById(sr_tab_content).style.display = 'block'; // display the content of the tab we need
      // now we get all tab menu items by class names (use the next code only if you need to highlight current tab)
      var x = document.getElementsByClassName("tabmenu");
      var i;
      for (i = 0; i < x.length; i++) {
           x[i].className = 'tabmenu'; 
      }
      document.getElementById(sr_tab_id).className = 'tabmenu active';
    }
   function showLogin(){
        $('#signup').css("display", "none");
        $('#login').css("display", "block");
      
   }
    function showSignup(){
        $('#login').css("display", "none");
        $('#signup').css("display", "block");
       
   }
    $(window).on('load',function(){
      //  $('#myModal').modal('show');
        $('#showError').hide();
    });
    
 function updateRegisterUser()
      {
        var GId=$('.is_customer_login').val();
        // var Email=$('#EmailGmail').val();
        var Password=$('#PasswordGmail').val();
         if(Password==''){
            $('#showError').show();
        }else{
             $.ajax({
                url: url+"User_authentication/updateUserByGmail",
                data:{Password:Password,GId: GId},
                method:"post",
                dataType : "json",
                success: function(data){
                 
                $('#myModal').modal('hide');
             
                }
            }); 
        }
   }

   function regUserImageUpload(){
 var GId = $('.is_customer_login').val();
var form = new FormData(); 
form.append("file", $(".file")[0].files[0]);

            $.ajax({
                        url: url+'User_authentication/AjaxImage?Gid='+GId, 

                        dataType: 'json', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form,
                        type: 'post',
                        success: function (response) {
                        var img= response.Profile;  
                        

                        $(".after_login_img").attr("src",img);
                        $(".imagechange").attr("src",img);
                      
                            $('#msg').html(response); // display success response from the server
                        },
                        error: function (response) {
                            $('#msg').html(response); // display error response from the server
                        }
                    });
                


   }
// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https:////connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.fbAsyncInit = function() {
  // $('#searchPushTop').css({'display':'none'});
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '617874882026245', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.0', // use graph api version 2.8
      status     : true
    });
    
    // Check whether the user already logged in
    // FB.getLoginStatus(function(response) {
    //     if (response.status === 'connected') {
    //         //display user data
            getFbUserData();
            getFbUserDatas();
    //     }
    // });
};



// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
Custombox.modal.close();
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {

      // document.getElementById('userDatas').innerHTML = '<div style="position: relative;"><img src="'+response.cover.source+'" /><img style="position: absolute; top: 90%; left: 25%;" src="'+response.picture.data.url+'"/></div><p><b>FB ID:</b> '+response.id+'</p><p><b>Name:</b> '+response.first_name+' '+response.last_name+'</p><p><b>Email:</b> '+response.email+'</p><p><b>Gender:</b> '+response.gender+'</p><p><b>Locale:</b> '+response.locale+'</p><p><b>Profile Link:</b> <a target="_blank" href="'+response.link+'">click to view profile</a></p>';
    //console.log(response);

                  
               $.ajax({
                url: url+"User_authentication/createUser",
                data:{FirstName: response.first_name,LastName:response.last_name,Email: response.email,Month: 'null',Day:'null',Year: 'null',Face_id:response.id, Login_Way:'fb', image:response.picture.data.url},
                method:"post",
                dataType : "json",
                success: function(data){

                  var eID= data.Member_ID;     
                  var img= data.Profile;  
                  // alert(data.Password);
                  $('.is_customer_login').val(data.Member_ID);
                               
                 if(data.status==='true'){

                     if(data.Password===''){

                         $('#myModal').modal('show');
                    }
     if(img !=""){
                        imgData= data.Profile;  
                    } 
                    else {
                        imgData=url+"assets/images/noprofile.png"; 
                    }
                  $("#showImg").attr("src",imgData);
                  $(".after_login_img").attr("src",imgData);
                  $(".after_login_name").text(data.FirstName+' '+data.LastName);
                  $("#spanname").text(data.FirstName+' '+data.LastName);


                  $('#sessionid').val(eID);


                  $('.after_login').css({'display':'block'});
                  $('.after_login_view_profile').css({'display':'block'});
                  $('.before_login').css({'display':'none'});

                  $("#EmailGmail").val(eID);

                  }
                
                   if(data=='Email Already Exists'){
                        $('#error-msg').show();
                  }

                }
            });

    });
}

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="fblogin.png"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
    });
}

function onLoadGoogleCallback(){
  gapi.load('auth2', function() {
    auth2 = gapi.auth2.init({
      client_id: '220791968929-0t28vr2jeliutgtnmnbsgja2qt7iajq1.apps.googleusercontent.com',
      cookiepolicy: 'single_host_origin',
      scope: 'profile email'
    });

  auth2.attachClickHandler(element, {},
    function(googleUser) {
//console.log(googleUser);
    	var name = googleUser.getBasicProfile().getName();
    	var email = googleUser.getBasicProfile().getEmail();
    	var accesstoken = googleUser.getBasicProfile().getId();
    	var image = googleUser.getBasicProfile().getImageUrl();
    	$.ajax({
            type: "POST",
                url: url+"User_authentication/googlelogin",
                data:{givenName:name,emails:email,id:accesstoken,image:image},
                crossDomain: true,
                dataType : "json",
                success: function(response){
                  var eID= response.Member_ID;    
                  if(response.status=="true"){
                    if(response.Password===''){
                         $('#myModal').modal('show');
                    }
                  $("#showImg").attr("src",response.Profile);
                  $("#spanname").text(response.FirstName);
                  $(".after_login_img").attr("src",response.Profile);
                  $(".after_login_name").text(response.FirstName+' '+response.LastName);
                  $('#sessionid').val(eID);
                  $('.after_login').css({'display':'block'});
                  $('.after_login_view_profile').css({'display':'block'});
                  $('.before_login').css({'display':'none'});
                  Custombox.modal.close();
                  }
                  else{
                      alert("error");
                  }
                }
            });
    }
		 );

    	
        
      }), function(error) {
        console.log('Sign-in error', error);
      }
  

  element = document.getElementById('googlebuttonclick');
}
 /* $(document).ready(function(){
    $('#googlebuttonclick').on('click', function() {
alert("hello");
      OAuth.initialize('o5PulHZ96T1-YIpL9xby2J1j2-8');
 
      OAuth.popup('google').then(google => {
        google.me().then(data => {
        });
   
        google.get('/plus/v1/people/me').then(data => {
    
    
           $.ajax({
            type: "POST",
                url: url+"User_authentication/googlelogin",
                data:data,
                crossDomain: true,
                dataType : "json",
                success: function(response){
                  var eID= response.Member_ID;    
                  if(response.status=="true"){
                    if(response.Password===''){
                         $('#myModal').modal('show');
                    }
                  $("#showImg").attr("src",response.Profile);
                  $("#spanname").text(response.FirstName);
                  $(".after_login_img").attr("src",response.Profile);
                  $(".after_login_name").text(response.FirstName+' '+response.LastName);


                  $('#sessionid').val(eID);


                  $('.after_login').css({'display':'block'});
                  $('.after_login_view_profile').css({'display':'block'});
                  $('.before_login').css({'display':'none'});
                  }
                  else{
                      alert("error");
                  }
                }
            });
        });
      });
    });
  });*/


//create user ajax
  function registerUser(){
          
            var FirstName=$('#FirstName').val();
            var LastName=$('#LastName').val();
            var Email=$('#EmailUser').val();
            var Password=$('#signupPassword').val();
            var Month=$('#month').val();
            var Day=$('#day').val();
            var Year=$('#year').val();

              if(Month == ''){
                Month =0;
              }            
              if(Day == ''){
                Day =0;
              }              
              if(Year == ''){
                Year =0;
              }
        $.ajax({
                url: url+"User_authentication/createUser",
                data:{FirstName: FirstName,LastName:LastName,Email: Email,Password:Password,Month: Month,Day:Day,Year: Year},
                method:"post",
                dataType : "json",
                success: function(data){
                  
                  $('.Verifymail').css({'display':'block'});
               //alert(data.insert[0]['Member_ID']);
                  var eID= data.Member_ID;     
                  var img= data.Profile;  
                    //alert(data.status);
                 if(data.status==='true'){
                    if(img !=""){
                        imgData= data.Profile;  
                    } 
                    else {
                        imgData=url+"assets/images/noprofile.png"; 
                    }
                  Custombox.modal.close();
                  $('#emailsignup').trigger( "click" );
                   //$('#emailsignupModal').modal("show");
                  $("#showImg").attr("src",imgData);
                  $(".after_login_img").attr("src",imgData);
                  $(".after_login_name").text(data.FirstName+' '+data.LastName);


                  $('#sessionid').val(eID);


                  $('.after_login').css({'display':'block'});
                  $('.after_login_view_profile').css({'display':'block'});
                  $('.before_login').css({'display':'none'});

                  $("#EmailGmail").val(eID);

                  // $('.close').trigger( "click" );


                  }
                  if(data=='Email Already Exists'){
                        $('#error-msg').show();
                  }

 
                $('.lastid').val(data.insert[0]['Member_ID']);

                $('#FirstName').val();
                $('#LastName').val();
                $('#EmailUser').val();
                $('#signupPassword').val();
                $('#month').val();
                $('#day').val();
                $('#year').val();

                }
            });
   }
//create user ajax


$('.uploadpc').click(function(){

$('.file').trigger("click");

});

function savegender(){
   $('#emailsignupModal').css('display','none');
  var lastid = $('.is_customer_login').val();
  var radioValue = $("input[name='gender']:checked").val();
       

        $.ajax({
                url: url+"User_authentication/updategender",
                data:{lastid :lastid, radioValue:radioValue},
                method:"post",
                dataType : "json",
                success: function(data){
                  $('.custombox-open').css('background-color','transparent');
                  // window.location.reload(); 

                }
            });
}


   $(document).mouseup(function (e)
  {
    var container = new Array();
    container.push($('#location-suggest'));
    container.push($('#suggestions'));
    
    $.each(container, function(key, value) {
        if (!$(value).is(e.target) // if the target of the click isn't the container...
            && $(value).has(e.target).length === 0) // ... nor a descendant of the container
        {
            $(value).hide();
        }
      });
  });
   $('.item').on('click',function(){

      var content= $(this).text();
      var newStr = content.replace(/(^\s+|\s+$)/g,'');
      
      $('#suggested-searches').val(newStr);
    });
     $('.item-loc').on('click',function(){

      var location_content= $(this).text();
      var newLoc = location_content.replace(/(^\s+|\s+$)/g,'');
      
      $('#suggested-location').val(newLoc);
    });
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLoginpicture() {
 
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserDatas();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserDatas(){

    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
    
    var imm = response.picture.data.url;
    $(".after_login_img").attr("src",imm);

    $(".imagechange").attr("src",imm);
    var mid = $('.is_customer_login').val();

               $.ajax({
                url: url+"User_authentication/NormalFB",
                data:{mid:mid, image:imm, Email:response.email},
                method:"post",
                dataType : "json",
                success: function(data){
                  

                }
            });

    });
}

$('.loginn').click(function(){

$('.signuphide').hide();
$('.loginhide').show();

})
$('.signinn').click(function(){

$('.loginhide').hide();
$('.signuphide').show();

})

////ResendMail///


function ResendMail(){

var id = $('.is_customer_login').val();

               $.ajax({
                url: url+"User_authentication/ResensMail",
                data:{id:id},
                method:"post",
                dataType : "json",
                success: function(data){
                    $(".sentMail").show();
                     $(".Verifymail").hide();
                }
            });
        }


////ResendMail///


function RecoverPassword(){
  var email = $('#recoverSrEmail').val();


                 $.ajax({
                url: url+"index.php/Forgot/RecoverPassword",
                data:{email:email},
                method:"post",
                dataType : "json",
                success: function(data){
                  //Custombox.modal.close();
                  // $('.close').trigger('click');  
                  if(data!=""){
                  $(".before").hide();
                  $('.resetmsg').html('You will receive a message at '+email+' if you have registered your account with that email address. Please check for an email from localinspire and click on the included link to reset your password.');
                  $('.resetmsg').css({'background': '#daecd2', 'margin-top': '50px', 'padding': '12px'});
                  }
                  else {
                       $(".before").hide();
                  $('.resetmsg').html('Your emailid not found in system.');
                  $('.resetmsg').css({'color': 'red', 'margin-top': '50px', 'padding': '12px'});
                  }

                }
            });


}

function CreatePassword(){

  var mail = $('#mail').val();
  var password = $('#password').val();
  var reenter = $('#reenter').val();
if(password == ''){
    $('.errpass').html('Password cannot be blank!');
    $('.errpass').css({'color': 'red'});

}else if(password == reenter){


                 $.ajax({
                url: "https://localinspire.com/new/Forgot/JsonPassword",
                data:{mail:mail,password:password,reenter:reenter},
                method:"post",
                dataType : "json",
                success: function(data){
                    $('.passchanged').show();
                    document.getElementById("mail").value = "";
                    document.getElementById("reenter").value = "";
                  //location.href = url+"forgot/reset"

                }
            });

}else{

  $('.err').html('The password must be the same!');
  $('.err').css({'color': 'red'});

}
}
var x = document.getElementById("currentlocation");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}