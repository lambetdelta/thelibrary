<?php
if (!function_exists('numerRamdomCryp')) {
    function numerRamdomCryp($length){
        $length = $length < 1 ? 1 : $length;
        $numbers = [];
        for ($i = 0; $i < $length; $i++) {
            $numbers[] = random_int(0, 10000);
        }
        return implode($numbers);
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd/m/Y h:i:s a'){
		if(is_numeric($date)){
			return gmdate($format, $date);
		}else{
			$fecha = new DateTime(str_replace('/', '-', $date));
			return $fecha->format($format);
		}
	}
}

if (!function_exists('getNumbers')) {
    function getNumbers($string){
    	return preg_replace('/[^0-9]+/', '', $string);
	}
}

if (!function_exists('formatStringJS')) {
    function formatStringJS($string){
    	return str_replace('"', '\"', $string);
	}
}
