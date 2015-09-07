<?php

class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $noInclude = false, $noHeader = false, $noFooter = false, $noHTML = false)
	{
        if($noHTML == false){
            require 'views/html_header.php';
            if ($noInclude) {
                require 'views/' . $name . '.php';
            }
            else {

                if(($noHeader == true) && ($noFooter == false)){

                    require 'views/' . $name . '.php';
                    require 'views/footer.php';
                }
                else if(($noHeader == false) && ($noFooter == true)){
                    require 'views/header.php';
                    require 'views/' . $name . '.php';
                }
                else{
                    require 'views/header.php';
                    require 'views/' . $name . '.php';
                    require 'views/footer.php';
                }
            }
            require 'views/html_footer.php';
        }
        else{
            require 'views/' . $name . '.php';
        }
	}
}