<?php 
	/**
		* this is the generic footer display template
		* must close the opening section tag that is written in the header.php
		* using section tags cause I'm all fancy and HTML5 fly and stuff...
		*
		* @package WordPress
		* @subpackage HIFI-basic
		* @since April 2014
	**/
?>
		</section> <!-- close the main section of the page -->
		<aside>
			<?php
				// incase we want to use a side bar in the future...
				// get_sidebar();
			?>
		</aside>
		<footer>
			<!-- we will eventually populate this section -->
		</footer>
	</body>
</html>
<!-- this line will generate the wordpress user interface when you are previewing the site while logged in -->
<?php wp_footer(); ?>