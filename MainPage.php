<?php function custom_panel(){
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
 
</table>
 
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="my_option_first,my_option_second,my_option_third" />
 
<p class="submit">
<input type="submit" class="button-primary" value="Сохранить" />
</p>
 
</form>
</div>';
}?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="assets/js/js.js"></script>