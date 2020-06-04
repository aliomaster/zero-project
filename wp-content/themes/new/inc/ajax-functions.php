<?php

// ajax get purchase data by day
add_action( 'wp_ajax_nopriv_get_purchase_data_by_day', 'get_purchase_data_by_day' );
add_action( 'wp_ajax_get_purchase_data_by_day', 'get_purchase_data_by_day' );
function get_purchase_data_by_day() {
    if ( $_POST['purchaseDate'] ) {
        $result = '<div class="alio-reading-box">';
        $data_arr = search_purchase_by_date( $_POST['purchaseDate'] );
        if ( $data_arr && is_array( $data_arr ) ) {
            $result .= '<h4>История покупок за ' . date("d.m.Y", strtotime( $_POST['purchaseDate'] ) ) . '</h4><div class="alio-reading-box-description alio-reading-box-additional">
                <ul class="check-history-list">';
                foreach ( $data_arr as $item_obj ) {
                    $item_title = get_the_title( $item_obj->product_id );
                    $item_count = $item_obj->product_count;
                    $item_unit = $unit = ( get_field( 'unit_for_product', $item_obj->product_id ) ) ? get_field( 'unit_for_product', $item_obj->product_id ) : '';
                    $item_price = $item_obj->price;

                    $result .= '<li>' . $item_title . ' ' . $item_count . ' ' . $item_unit . ' - ' . $item_price . ' руб</li>';
                }
            $result .= '</ul></div>';
        } else {
            $result = 'Новая дата';
        }

        $result .= '</div>';
    } else {
        $result = 'Ошибка!';
    }
    echo $result;
    wp_die();
}

// ajax save check
add_action( 'wp_ajax_nopriv_save_check', 'save_check' );
add_action( 'wp_ajax_save_check', 'save_check' );
function save_check() {
    $success = 'Расходы успешно внесены!';
    if ( $_POST['prod'] && $_POST['buy_date'] ) {
        $prod_array = array();
        $arr_prod = explode( ', ', $_POST['prod'] );
        $current_user = get_current_user_id();
        foreach ( $arr_prod as $key => $value ) {
            if ( ! empty( $value ) ) {
                $cut = explode( "-", $value );
                if ( count( $cut ) == 3 ) {
                    $prod_array[] = array(
                        'product_id' => $cut[0],
                        'date' => $_POST['buy_date'],
                        'cnt' => $cut[1],
                        'price' => $cut[2],
                    );
                }
            }
        }

        if ( $prod_array ) {
            foreach ( $prod_array as $item_prod ) {
                global $wpdb;
                $wpdb->show_errors( true );
                $res = search_by_date_id_prod( $item_prod['date'], $item_prod['product_id'] );
                if ( ! $res ) {
                    $wpdb->insert( 'wp_costs_calculating', array(
                        'ID' => '',
                        'user_id' => 1,
                        'date' => $item_prod['date'],
                        'product_id' => $item_prod['product_id'],
                        'product_count' => $item_prod['cnt'],
                        'price' => $item_prod['price'],
                    ) );
                } else {
                    if ( count( $res ) == 1 ) {
                        $tbl_id = $res[0]->ID;
                        $current_cnt = $wpdb->get_var( $wpdb->prepare( 'SELECT product_count FROM ' . $wpdb->prefix . 'costs_calculating WHERE ID="%s" LIMIT 1', $tbl_id ) );
                        $current_price = $wpdb->get_var( $wpdb->prepare( 'SELECT price FROM ' . $wpdb->prefix . 'costs_calculating WHERE ID="%s" LIMIT 1', $tbl_id ) );
                        $new_cnt = $current_cnt + $item_prod['cnt'];
                        $new_price = $current_price + $item_prod['price'];
                        $res_update = $wpdb->update( 'wp_costs_calculating', array(
                            'user_id' => $current_user,
                            'date' => $item_prod['date'],
                            'product_id' => $item_prod['product_id'],
                            'product_count' => $new_cnt,
                            'price' => $new_price,
                        ), array( 'ID' => $tbl_id ) );
                        if ( $res_update === false ) {
                            $success = "Произошла ошибка!";
                        }
                    }
                }
            }
        }

    echo $success;
    wp_die();
    }
}


// ajax goal show
add_action( 'wp_ajax_nopriv_get_day_content', 'get_day_content' );
add_action( 'wp_ajax_get_day_content', 'get_day_content' );
function get_day_content() {
    if ( $_POST['goalID'] && $_POST['goalDate'] && $_POST['goalMY'] ) {
        $goalID = $_POST['goalID'];
        $goalDate = $_POST['goalDate'];
        $goalMY = $_POST['goalMY'];
        $res = '';
        if ( $post_goal = get_post( $goalID ) ) {
            $res = '<img src="http://fly-journal/wp-content/themes/fly-journal/img/loader.gif" class="loading_add" alt=""><div class="box_data_heading"><span class="details_date">' . $goalDate . '</span><span class="details_mounth">' . $goalMY . '</span>';
            if ( $close_goal = get_field( 'close_goal', $goalID ) ) {
                $res .= '<ul class="ratio_area">';
                $count = 5;
                for ( $i = 1; $i <= $close_goal; $i++ ) {
                    $res .= '<li class="full_star"></li>';
                    $count -= 1;
                }
                for ( $i = 1; $i <= $count; $i++ ) {
                    $res .= '<li class="empty_star"></li>';
                }
                $res .= '</ul>';
            }
            $res .= '<hr class="details_devider"></div><div class="goal_text">';
            if ( $goal = get_field( 'goal', $goalID ) ) {
                $res .= '<h3>Цель</h3><div class="goal_content">' . $goal . '</div>';
            }

            if ( $wins = get_field( 'wins', $goalID ) ) {
                $res .= '<h3>Победы дня*</h3><div>' . $wins . '</div>';
            }
            if ( $mistakes = get_field( 'mistakes', $goalID ) ) {
                $res .= '<h3>Ошибки дня*</h3><div>' . $mistakes . '</div>';
            }
            if ( $the_reason = get_field( 'the_reason', $goalID ) ) {
                $res .= '<h3>Причины ошибок*</h3><div>' . $the_reason . '</div>';
            }
            if ( $conclusions = get_field( 'conclusions', $goalID ) ) {
                $res .= '<h3>Выводы*</h3><div>' . $conclusions . '</div>';
            }
            if ( $wins || $mistakes || $the_reason || $conclusions ) {
                $res .= '<div class="note">* - исключительно в контексте приближения к указанной цели.</div>';
            }
            $res .= '</div>';
        }
        $url = get_permalink( $goalID );
        $res .= '<a href="' . $url . '" class="btn btn-sm btn-primary">Редактировать</a>';
        echo $res;
    }

    wp_die();
}


