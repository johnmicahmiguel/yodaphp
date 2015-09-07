<?php

class Index extends Controller {

	function __construct() {
        parent::__construct();
	}
        
	function index() {
        $this->view->page_title = "Yodaphp | Home";
        $this->view->render('index/index');
	}
        
}