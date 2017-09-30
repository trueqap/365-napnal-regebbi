<?php

/**
* Plugin Name: 365-napnal-regebbi
* Plugin URI: https://github.com/trueqap/365-napnal-regebbi/
* Description: 365 napnál régebbi WordPress post figyelmeztetés
* Version: 1.0
* Author: trueqap
* Author URI: Author's website
* License: GPL2
*/


function time2string($timeline) {
    $periods = array('napja' => 86400, 'órája' => 3600, 'perce és' => 60, 'másodperce' => 1);

    foreach($periods AS $name => $seconds){
        $num = floor($timeline / $seconds);
        $timeline -= ($num * $seconds);
        $ret .= $num.' '.$name.(($num > 1) ? '' : '').' ';
    }

    return trim($ret);
}

function egy_ev_figyelmeztetes( $content ) {
  global $post;
  if( strtotime( $post->post_date ) < strtotime('-365 days') ) {

    $eltelt_ido = time2string(time()-strtotime($post->post_date));

    $tartalom = '<span class="mks_highlight" style="background-color: #e0e0e0">Ez a tartalom <strong>'.$eltelt_ido.'</strong> frissült utoljára. A benne szereplő információk a publikálás idején pontosak voltak, de mára elavultak lehetnek.</span><br><br>';
    }
    $tartalom .= $content;
return $tartalom;
}
add_filter( 'the_content', 'egy_ev_figyelmeztetes' );
