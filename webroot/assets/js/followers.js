(function (d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s);
	js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.fbAsyncInit = function () {
	FB.init({
		appId: '363493931189519', // FB App ID
		cookie: true, // enable cookies to allow the server to access the session
		xfbml: true, // parse social plugins on this page
		version: 'v4.0', // use graph api version 2.8
		status: true
	});
get_facebook_friends();

}
function get_facebook_friends() {
	FB.login(function (response) {
		if (response.authResponse) {
		  //  console.log(response);
			// Get and display the user profile data
			get_facebook_friends_data();
		} else {
			document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
		}
	}, {
		scope: 'email, user_friends'
	});
}

function get_facebook_friends_data(){
    FB.api(
        "/149208372849107/permissions",
        function (response) {
          if (response && !response.error) {
            console.log(response);
          }
        }
    );
}
