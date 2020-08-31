<?php
//Add image downloader

		
	function custom_panel(){
		$w=100;
		$h=100;
		$default = 'localhost/timetable/wp-content/uploads/2020/08/MG_4660.jpg';
		if( $value ) {
			$image_attributes = wp_get_attachment_image_src( $value, array($w, $h) );

			$src = $image_attributes[0];
			$GLOBALS["src"]=$src;
			
		} 
		else{
			$src=$default;
		}

		if(isset($_POST['action']))
		{
			$GLOBALS["default"]='localhost/timetable/wp-content/uploads/2020/08/MGs0.jpg';
		}

	echo '<div class="wrap">
	<h2>Сохраняем опции плагина</h2>
	 
	<form method="post" action="options.php">
	'.wp_nonce_field('update-options').'
	 
	<table class="form-table">
	 
	<tr valign="top">
	<th scope="row">Опция 1</th>
	<td><input type="text" name="my_option_first" value="'.get_option('my_option_first').'" /></td>
	</tr>
	
	<tr valign="top">
	<th scope="row">Опция 2</th>
	<td><input type="text" name="my_option_second" value="'.get_option('my_option_second').'" /></td>
	</tr>
	 
	<tr valign="top">
	<th scope="row">Опция 3</th>
	<td><input type="text" name="my_option_third" value="'.get_option('my_option_third').'" /></td>
	</tr>

	<!-- Загрузка изображений-->

	<tr valign="top">
	<th scope="row">Опция 4</th>
	<td>
	<img src="' . $src . '" width="' . $w . 'px" height="' . $h . 'px" />
	<div>
		<button  class="upload_image_button button">Загрузить</button>
		<button  class="remove_image_button button">×</button>
	</div>
	</td>
	</tr>
	

	</table>
	 
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="my_option_first,my_option_second,my_option_third" />
	 
	<p class="submit">
	<input type="submit" class="button-primary" value="Сохранить" />
	</p>
	 
	</form>
	</div>';?>
	<input type="text" id="logo-url" placeholder="No media selected!"  readonly="readonly" value="<?php if($LogoUrl) echo $LogoUrl; ?>" />
	<input type="button" id="upload-logo" class="button upimg" value="Upload Logo"/>
	<div id="img-prev">
	 <img src="<?php echo $LogoUrl; ?>" class="logo-prv" id="logo-img-prv" alt="" <?php if($LogoUrl == "") echo "style='display:none;'"; ?>>
	 </div>
	 <input id="save-logo-settings" name="save-logo-settings" class="button-primary button-large" onclick="return savesettings();" type="button" value="<?php _e("Save Settings", "WebritiCustomLoginTD"); ?>">
<?php
	}
	//save plugin settings
add_action("wp_ajax_save_logo_settings", "savelogosettings");
function savelogosettings() {
    if(isset($_POST['action']) == "save_logo_settings") {
        print_r($_POST);
        $EnableLogo = $_POST['EnableLogo'];
        $LogoUrl = $_POST['LogoUrl'];
        $CustomBGColor = $_POST['CustomBGColor'];
        $Settings = array(
            'enable_logo' => $EnableLogo,
            'logo_url' => $LogoUrl,
            'custom_bg_color' => $CustomBGColor
        );
        update_option('wp_login_logo_settings', $Settings);
    }
}
//loading logo settings
function applying_wp_custom_login_settings() {
    $Settings = get_option('wp_login_logo_settings');
    $EnableLogo = $Settings['enable_logo'];
    $LogoUrl = $Settings['logo_url'];
    $CustomBGColor = $Settings['custom_bg_color'];
    if($EnableLogo == 'yes') { ?>
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
                background-image: url('<?php echo $LogoUrl; ?>');
                max-height: 67px;
                max-width: 326px;
                width: auto;
                overflow: hidden;
            }
        <?php
        } ?>
            .login #backtoblog a {
                text-shadow: none;
            }
            .login #nav a {
                text-shadow: none;
            }
        </style><?php
    }
}
add_action( 'login_enqueue_scripts', 'applying_wp_custom_login_settings' );
	
?>
	<script>
        // hide n show upload button
        jQuery('#enable-custom-logo').click(function(){
            if (jQuery(this).is(':checked', true)) {
                alert(1);
            } else {
                alert(2);
            }
        });

        //settings save js function
        function savesettings() {
            var EnableLogo = jQuery('input[type="radio"]:checked').val();
            var LogoUrl = jQuery("#logo-url").val();
            var CustomBGColor = jQuery("#custom-background-color").val();
            var PostData = "action=save_logo_settings&EnableLogo=" + EnableLogo + "&LogoUrl=" + LogoUrl + "&CustomBGColor=" + CustomBGColor;
            jQuery.ajax({
                dataType : 'html',
                type: 'POST',
                url : ajaxurl,
                cache: false,
                data : PostData,
                complete : function() {  },
                success: function(data) {
                    alert("<?php _e("Settings successfully saved.", "WebritiCustomLoginTD"); ?>");
                }
            });
		}

		</script>
		<?php
