<?php
	$username = '';
	if(have_posts()) {
		while(have_posts()) {
			the_post();
			$content = get_the_content();
			preg_match('/(.*)\[layoutboxx(.*)username="(\w+)"(.*)\](.*)/', $content, $GLOBALS['username']);
			$GLOBALS['username'] = $GLOBALS['username'][3];
		}
	}
?>
<html>
	<head>
		<title><?php wp_title(''); ?></title>
		<style>
			* {
				height: 0; width: 0;
				max-height: 100%; max-width: 100%;
				min-height: 100%; min-width: 100%;
				padding:0; margin: 0; border: none;
			}
		</style>
	</head>
	<body>
		<iframe src="https://designer.layoutboxx.com/<?php echo $username; ?>/"></iframe>
	</body>
</html>
