<?php

namespace App\Ncucc;
use Session, Request;

class MenuUtils {
	public static function showable($nav) {
			$html = null;
		 foreach ($nav as $key => $item) {
			$items = array_key_exists('items', $item) ? $item['items'] : false;
 			$name = array_key_exists('name', $item) ? $item['name'] : '';
 			$url = array_key_exists('url', $item) ? url( $item['url'] ) : '#';
 			$active = array_key_exists('url', $item) ? Request::is($item['url'] .'/*') : false;
 			$role = array_key_exists('role', $item) ? ($item['role'] ) : '';
			
 			
 			# 僅判斷登出登入，還需要加強權限的判斷與中介層的控制
 			$returnCode = Session::get('returnCode');
 			if( $returnCode == 1 && $name == 'login' ) {
 				continue;
 			}
 			if( !isset( $returnCode ) && ($name != 'login' )) {
 				continue;
 			}
 			
			$html .= '<li><a href="'. $url .'">'. trans('menu.'. $name) .'</a>';
			
			if( $items ) {
				$html .= '<ul>' . self::showable( $items ) . '</ul>';
			}
		 	$html .= '</li>';
		}
		return $html;
	}
}
?>