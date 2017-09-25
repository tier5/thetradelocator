<?php
/**
 * Footer template
 *
 * @package wyz
 */

?>
<!--[if !IE 7]>
	<style type="text/css">
		#wrap {display:table;height:100%}
	</style>
<![endif]-->

<?php

$footer = new WYZIFooterFactory();
$footer->the_footer();

wp_footer();?>

</body>
</html>
