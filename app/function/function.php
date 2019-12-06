<?php
	/**
	 * Mở composer.json
	 * Thêm vào trong "autoload" chuỗi sau
	 * "files" : [
	 *  	"app/function/function.php"
	 *	]
	 * Chạy cmd composer dumpautoload
	 */
	function utf8convert($str) {
        if(!$str) return false;
        $utf8 = array(
		    'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		    'd'=>'đ|Đ',
		    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		    'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
		    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		    'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
        foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
			return $str;
	}
	function utf8tourl($text){
        $text = strtolower(utf8convert($text));
        $text = str_replace( "ß", "ss", $text);
		$text = str_replace( "%", "", $text);
		$text = str_replace( "(", "", $text);
        $text = str_replace( "?", "", $text);
        $text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
        $text = str_replace(array('%20', ' '), '-', $text);
        $text = str_replace("----","-",$text);
        $text = str_replace("---","-",$text);
        $text = str_replace("--","-",$text);
		return $text;
	}
	function download_file($dir, $link, $css, $icon, $text){

	    if(!empty($link) && !empty($dir)){
            return '<a class="btn '.(!empty($css) ? $css : 'btn-danger btn-sm' ).'" href="'.url($dir.$link).'" download><i class="fa '.(!empty($icon) ? $icon : 'fa-download' ).'"></i> '. (!empty($text) ? $text : 'Tải về') .'</a>';
        }else{
            return 'Không thành công, vui lòng kiểm tra lại liên kết, liên kết không được để trống!!!';
        }

	}
	function download_tl($dir, $link, $css, $icon, $text){

	    if(!empty($link) && !empty($dir)){
            return '<a style="border-radius: 0;padding: 1px 7px 1px 7px;" class="btn '.(!empty($css) ? $css : 'btn-danger btn-sm' ).'" href="'.url($dir.$link).'" download><i class="fa '.(!empty($icon) ? $icon : 'fa-download' ).'"></i> '. (!empty($text) ? $text : 'Tải về') .'</a>';
        }else{
            return 'Không thành công, vui lòng kiểm tra lại liên kết, liên kết không được để trống!!!';
        }

    }
?>