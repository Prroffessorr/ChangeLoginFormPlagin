<?php
//save plugin settings
add_action("wp_ajax_save_logo_settings", "savelogopagesettings");
function savelogopagesettings() {
    if(isset($_POST['action']) == "save_logo_settings") {
        print_r($_POST);
        //$EnableLogo = $_POST['EnableLogo'];
        $LogoUrl = $_POST['LogoUrl'];
        $CustomBGColor = $_POST['CustomBGColor'];
        $Settings = array(
            //'enable_logo' => $EnableLogo,
            'logo_url' => $LogoUrl,
            'custom_bg_color' => $CustomBGColor
        );
        update_option('wp_login_logo_settings', $Settings);
    }
}

//reset plugin settings
add_action("wp_ajax_reset_logo_settings", "resetlogopagesettings");
function resetlogopagesettings() {
    if(isset($_POST['action']) == "reset_logo_settings") {
        $Settings = array(
            //'enable_logo' => "no",
            'logo_url' => "",
            'custom_bg_color' => ""
        );
        update_option('wp_login_logo_settings', $Settings);
    }
}

//loading logo settings
function applying_wp_custom_login_page_settings() {
    $Settings = get_option('wp_login_logo_settings');
    //$EnableLogo = $Settings['enable_logo'];
    $LogoUrl = $Settings['logo_url'];
    $CustomBGColor = $Settings['custom_bg_color'];
    //if($EnableLogo == 'yes') { ?>
    
        <style type="text/css">
        <?php
        if($CustomBGColor != "") { ?>
            body {
                
                 background-color: <?php echo $CustomBGColor; ?> !important; 
            }  
        <?php
        }
        if($LogoUrl != "") {
        ?>
            body.login div#login h1 a {
                display:none;
            }
            .login form .input, .login input[type=text]{
                
            }
            body.login .authorization{
                justify-content: center;
                margin-right: 15px;
                padding-bottom: 5px;
                display: inline-block;
                border-bottom: 2px solid #1161ee;
                position: fixed;
                left: 50%;
                transform: translate(-50%, -50%);
                margin-top: -300px;
                text-transform: uppercase;
                color:#000;
               
            }

            body.login #error_message{
                display: none;
                padding-bottom: 5px;
                text-align:center;
                margin-top: 20px;
                text-transform: uppercase;
                color: #000 ;
                font: 600 16px/18px 'Open Sans', sans-serif !important;
                border-radius: 25px;
                background: #ff8d00;
                padding: 5px;
                position: fixed;
                left: 50%;
                transform: translate(-50%, -50%);
                margin-top: 130px;
            }
            body #login .message{
                display: none;
            }
            
        <?php
        } ?>
           
        #loginform p.submit, #login form p{
                margin: 0px ;
                margin-bottom: 10px;
                padding:0px;
                
            }
            
            .login form {
                background-image: url('<?php echo $LogoUrl; ?>') !important;
                background-position: center !important; 
                background-repeat: no-repeat !important; 
                background-size: cover !important;
                text-align:center;
                display: table-cell;
                vertical-align: middle;
                box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19) !important;
                padding: 120px 90px 120px 90px !important; 
                position: fixed !important;
                top: 50%; left: 50% !important;
                transform: translate(-50%, -50%);

                
            }
            .login form .submit #wp-submit, #user_pass, #user_login{
            width: 100% !important;
            display: block;
            min-height: 60px;
            border: none;
            padding: 15px 50px;
            border-radius: 25px;
            text-align: center;
            margin-top:25px;
            z-index:2;
            
            }
            .login form .submit #wp-submit{
                background: #1161ee !important;
                font: 600 16px/18px 'Open Sans', sans-serif !important;
                text-transform:uppercase;
            }
            .login form p{
                color: #aaa;
                margin-top: 10px;
                margin-bottom: 10px;
                text-transform: uppercase;
                text-align:  center !important; 
                margin:20px;
            }

        </style>
        <?php
   //}

}
add_action( 'login_enqueue_scripts', 'applying_wp_custom_login_page_settings' );


 function gettext_filter($translation, $orig, $domain) {
    
    switch($orig) {
        case 'Username or Email Address':
            $translation = "Username";
            break;
        case 'Username':
            $translation = "Username";
            break;
        case 'Password':
            $translation = 'Password';
            break;
        case 'Log In':
            $translation = 'Увійти';
            break;
        
    }
    return $translation;
}
add_filter('gettext', 'gettext_filter', 10, 3); 

