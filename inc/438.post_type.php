<?php
function cp_438(){
	register_post_type('',
	[
		'labels'=>[ 'name' => __(''),
		],
		'public' => false,
		'show_ui' => false,
		'supports' => [] 
	]);	
		}
	add_action('init','cp_438');