<?php

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_filter( 'genesis_attr_entry', 'ep_service_genesis_attributes_entry', 20 );

add_filter('genesis_attr_entry-title','ep_service_genesis_attributes_entry_title');

add_action('genesis_entry_content', 'ep_service_shchema_meta');



genesis();