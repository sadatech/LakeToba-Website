// Load the SDK asynchronously
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if ( typeof eltdSocialVars !== 'undefined' ) {
    var facebookAppId = eltdSocialVars.social.facebookAppId;
}
if ( facebookAppId ) {
    window.fbAsyncInit = function() {
        FB.init({
            appId      : facebookAppId,
            cookie     : true,  // enable cookies to allow the server to access
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function($) {

    eltdInitFacebookLogin();
    eltdInitGooglePlusLogin();

    function eltdInitFacebookLogin() {

        var fbButton = $('#eltd-facebook-login');
        fbButton.click(function(e){
            e.preventDefault();
            window.FB.login( function( response ) {
                eltdFacebookCheckStatus( response );
            }, {scope: 'email, public_profile'} );
        });

    }

    function eltdFacebookCheckStatus( response ) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            eltdGetFacebookUserData();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    // After login is successful get user data
    function eltdGetFacebookUserData() {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', { 'fields': 'id, name, email, link' }, function(response) {
            response.loginPage = true;
            var data = {
                action : 'search_and_go_elated_check_facebook_user',
                response : response
            };

            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedAjaxUrl,
                success: function(data) {
                    var response;
                    response = JSON.parse(data);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    function eltdInitGooglePlusLogin() {

        if ( typeof eltdSocialVars !== 'undefined' ) {
            var clientId = eltdSocialVars.social.googleClientId;
        }
        if ( clientId ) {
            gapi.load('auth2', function(){
                window.auth2 = gapi.auth2.init({
                    client_id: clientId
                });
                eltdInitGooglePlusLoginButton();
            });
        } else {
            var gButton = $('#eltd-google-login');
            gButton.click(function(e) {
                e.preventDefault();
            });
        }

    }

    function eltdInitGooglePlusLoginButton() {

        var gButton = $('#eltd-google-login');
        gButton.click(function(e) {
            e.preventDefault();
            window.auth2.signIn();
            eltdSignInCallback();
        });

    }

    function eltdSignInCallback() {
        var signedIn = window.auth2.isSignedIn.get();
        if ( signedIn ) {
            var currentUser = window.auth2.currentUser.get(),
                profile = currentUser.getBasicProfile(),
                userData = {
                    id : profile.getId(),
                    name : profile.getName(),
                    email : profile.getEmail(),
                    loginPage : true
                },
                data = {
                    action : 'search_and_go_elated_check_google_user',
                    response : userData
                };

            $.ajax({
                type: 'POST',
                data: data,
                url: ElatedAjaxUrl,
                success: function(data) {
                    var response;
                    response = JSON.parse(data);
                    console.log(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        }
    }

})(jQuery);