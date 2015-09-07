<?php

class Profile {

	function __construct(){

	}

	public static function p_flag($str){

		if(ALLOW_PROFILE){
			global $prof_timing, $prof_names;
		    $prof_timing[] = microtime(true);
		    $prof_names[] = $str;
		}
		else{
			return;
		}
	}

	public static function p_print(){

		if(ALLOW_PROFILE){
			global $prof_timing, $prof_names;
		    $size = count($prof_timing);
		    for($i=0;$i<$size - 1; $i++)
		    {
		        echo "<b>{$prof_names[$i]}</b><br>";
		        echo sprintf("&nbsp;&nbsp;&nbsp;%f<br>", $prof_timing[$i+1]-$prof_timing[$i]);
		    }
		    echo "<b>{$prof_names[$size-1]}</b><br>";
		}
		else{
			return;
		}
	}
}