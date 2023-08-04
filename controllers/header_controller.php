
<?php
	// Check if cookie is set
	if (isset($_COOKIE['mode'])) {
		// Get mode from cookie
		$mode = $_COOKIE['mode'];

		// Include the appropriate CSS file based on mode
		if ($mode == 'light') {
			echo '<link rel="stylesheet" href="../views/css/light_style.css">';
		} else if ($mode == 'dark') {
			echo '<link rel="stylesheet" href="../views/css/dark_style.css">';
		}
	}
	?>