<?php
/**
 * Plugin Name: Cmd+S Save for Pages/Posts
 * Description: Allows saving posts/pages in the WordPress admin by pressing Command+S (Mac) or Ctrl+S (Windows/Linux).
 * Author: GitHub Copilot
 */

add_action('admin_enqueue_scripts', function($hook) {
	// Only run on post/page edit screens.
	if (in_array($hook, ['post.php', 'post-new.php'])) {
		?>
		<script>
		document.addEventListener('keydown', function(e) { 
			// Cmd+S (Mac) or Ctrl+S (Win/Linux)
			if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 's') {
				// Prevent browser's default save dialog
				e.preventDefault();
				// Try to click the "Update" or "Publish" button in block or classic editor
				let btn =
					document.querySelector('.editor-post-publish-button') || // Gutenberg "Publish"
					document.querySelector('.editor-post-save-draft') || // Gutenberg "Save draft"
					document.querySelector('.editor-post-update') || // Gutenberg "Update"
					document.querySelector('#publish'); // Classic editor "Publish/Update"
				if (btn && !btn.disabled) {
					btn.click();
				}
			}
		});
		</script>
		<?php
	}
});
