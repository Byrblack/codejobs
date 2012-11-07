<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Configuration_Controller {
		
	public function __construct() {		
		$this->application = $this->app("configuration");
		
		$this->Configuration_Model = $this->model("Configuration_Model");
		
		$this->Templates = $this->core("Templates");
		$this->Cache 	 = $this->core("Cache");
	}
	
	public function world() {
		if(POST("country")) {
			$country = POST("country");

			$vars["data"] = $this->Cache->data("cities-$country", "world", $this->Configuration_Model, "getCities", array($country));

			$this->view("cities", $vars, $this->application);
		}
	}

}