<?php
/****************************************/

//SHOW IN USER-AREA/BACKEND
add_action('admin_menu', 'layoutboxx_admin');
function layoutboxx_admin() {
    add_menu_page('LayoutBoxx', 'LayoutBoxx', 'edit_posts', 'layoutboxx', 'layoutboxx_admin_gui', "dashicons-format-image");
}

function layoutboxx_admin_gui() {
?>

<div class="wrap">

    <h1>LayoutBoxx</h1>
    <h2 class="nav-tab-wrapper">
		<a class="nav-tab nav-tab-active">How to</a>
		<a href="mailto:support@layoutboxx.com?subject=LayoutBoxx Wordpress Plugin:" target="_blank" class="nav-tab">Support</a>
    </h2>

    <h2>How to use it</h2>
    <p>
		The LayoutBoxx Wordpress Plugin uses a so called shortcode to make life easier for you. A shortcode is a simplified code snippet working only under Wordpress while this plugin is active.<br />
		Just copy and paste the following shortcode snippet and post it anywhere on your page.<br /><br />
		<kbd>[layoutboxx username="my_username"]</kbd><br />
		<i>Replace "my_username" with your LayoutBoxx username.</i>
	</p>

	<h2>Generator</h2>
	You can also use the following generator to generate your shortcode.
	<form>
		<script type="text/javascript">
			function generate(){
				document.getElementById("code").value = '[layoutboxx username="' + document.getElementById("username").value + '"]';
				return false;
			}
		</script>
		<input id="username" name="username" type="text" style="width: 100%; margin-bottom: 0.3em;" placeholder="LayoutBoxx username" />
		<input id="code" name="code" type="text" style="width: 100%; font-family: monospace; margin-bottom: 0.3em;" onclick="this.focus();this.select()" readonly="readonly" /><br />
		<input class="button button-primary" type="button" style="width: 100%;" value="Generate" onclick="generate();" />
	</form>

	<h2>Embed in fullscreen mode</h2>
	<p>
		You can also embed your LayoutBoxx Designer into Wordpress site looking like https://designer.layoutboxx.com/[username]/ (the normal Designer). Using this is quite simple. Just follow the steps above with the shortcode. If you now want to change to the fullscreen mode, select the page template "LayoutBoxx Fullscreen". And if you dont like it or want to have your navigation back, simply swap back to another template. The chosen title will be shown on the tab of your browser.
	</p>

    <h2>Tipps</h2>
	<p>
		<strong>1. Use the shortcode feature of Gutenberg</strong><br />
		If you are using the newest Wordpress version with its new editor called "Gutenberg" (the one where you can add blocks), you can easily add shortcodes by adding a shortcodes block to your site. You can now paste your LayoutBoxx shortcode inside this block.
	</p>
	<p>
		<strong>2. Deactivate the sidebar</strong><br />
		If your theme has a sidebar and it offers an option to deactivate it (on specific pages), then do it! Some themes also let you choose between a normal mode and a fullwidth mode. Deactivating sidebars makes the screen bigger. In this case your customer will have even more space to work.
	</p>
	<p>
		<strong>3. Still not big enough? Use the given HTML file or swap to fullscreen mode</strong><br />
		When you log into your LayoutBoxx account you can find a download link underneath the embed code. This will give you a file called <kbd>designer.html</kbd>. You can upload this anywhere you want (e.g. https://my-domain.com/designer.html). This makes it 100% in width and height. A little bit more fitting into wordpress giving the same result is the option to swap the page template where you posted the shortcode to "LayoutBoxx Fullscreen" (see above).
	</p>

<?php } ?>
