<?php

// WPM HEADING

add_shortcode( 'wpm_heading', 'wpm_heading' );

function wpm_heading( $atts, $content=NULL ) {
	extract( shortcode_atts( array(
		'anim' => '',
		'title' => '',
		'tag' => 'h2',
		'pos' => '',
		'tcuscolor' => '',
		'class' => '',
	), $atts ) );
	$anim = ( !empty( $anim ) ) ? 'animation ' . $anim : '';
	$tcuscolor = ( isset( $tcuscolor ) && ! empty( $tcuscolor ) ) ? ' style="color:' . $tcuscolor . ' !important"' : '';
	$out = '';
	$out .= '<div class="wrap">';
		$out .= '<' . $tag . ' class="' . $type . ' ' . $pos . ' ' . $class . ' ' . $anim . '"' . $tcuscolor . '>' . $title .'</' . $tag . '>';
	$out .= '</div>';
	return $out;
}

// WPM PRODUCTS LISTING

add_shortcode('wpm_prodlist', 'wpm_prodlisting');

function wpm_prodlisting( $atts, $content=NULL ){
    extract( shortcode_atts( array(
        "limit" => 6,
        "featured" => 0,
        'class'=>'',
        'filter' => ''
        ), $atts ) );
    global $post;
    $return = '';
    $counter = 0; 
    $randomId=  mt_rand(0, 10000);
//  $isActive = 'active';
    $args = array( 'post_type' => 'products', 'taxonomy'=> 'productscategory', 'showposts' => $limit, 'posts_per_page' => $limit, 'orderby' => 'date','order' => 'DESC');

    if ( $featured ) {
        $args['meta_query'] = array( array( 'key'=>'_products_featured' ) );
    }

    $query = new WP_Query( $args );
    $return .= '<div id="projects" class="home-works1 practice-area ' . $class . '">';
        if( $filter == 'true' ):
            $return .= '<div class="row text-center">
                        <div class="isotope-nav" data-isotope-nav="isotope">
                        <ul class="non-paginated" id="filters">
                            <li><a class="filter active" data-filter="*">' . __('All', 'wordpress') . '</a></li>';
                            $cats = get_post_meta( $post->ID, "_page_products_cat", $single = true);
                            $MyWalker = new ProductsWalker();
                            $argsfilter = array( 'taxonomy' => 'productscategory', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'echo' => '0');
                            $categories = wp_list_categories ($argsfilter);
                            $return .= $categories . '</ul>
                    </div></div>';
        endif; 
        $return.='<div id="isotope" class="isotope"><div class="row">';
    if ( $query->have_posts() ):  
        while ( $query->have_posts()) :
            $query->the_post();
            $cats = wp_get_object_terms( $post->ID, 'productscategory' );
            if ( $cats ):
                $cat_slugs = '';
                foreach( $cats as $cat ) {
                    $cat_slugs .= $cat->slug . " ";
                }
            endif;
            $link = ''; $thumbnail = get_the_post_thumbnail($post->ID, 'sizeThumb');
            //if ($counter == 0 || $counter % 4 == 0): $return.='<div class="item"><div class="row">'; endif;
            $return.='<div class="col-sm-1 isotope-item '.$cat_slugs.'" data-productname="' . get_the_title() . '">
                    <div class="grid">
                    <figure class="effect-oscar">';
                    if ( !empty( $thumbnail ) ): 
                        $return .= $thumbnail; 
                    else :
                        $return .= '<img src = "http://placehold.it/273x238.jpg" alt="' . __('No image', 'wordpress') . '" />';
                    endif;
                    $return .= '<figcaption>';
                    $return.='<a href="#" class="link js_pop_up" title="">
                            <i class="fa fa-plus-square-o"></i>
                            </a>';
                        $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
                        $link = $full_image[0];
                        $return.='<a  href="'.$link.'" class="view" data-rel="prettyPhoto" data-title="'.get_the_title().'">
                                    <i class="fa fa-search"></i>
                                </a>';
                    $return.='</figcaption>
                            </figure>
                            <h3 class="text-center"><a  href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h3>
                        </div>
                    </div>';
                //if ($counter >0 && ($counter+1) % 4 == 0): $return.='</div></div>'; endif;                            
                $counter ++; endwhile; 
                endif;
    $return.='</div></div></div>';
    return $return;
}

// Alio Divider Shortcode

add_shortcode('alio_right_divider', 'alio_right_divider');

function alio_right_divider() {
    $out = '<div class="alio-right-divider"></div>';

    return $out;
}