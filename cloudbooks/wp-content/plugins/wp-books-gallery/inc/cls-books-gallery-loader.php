<?php
/**
 * General action, hooks loader
*/
class WBG_Loader {

	protected $wbg_actions;
	protected $wbg_filters;

	/**
	 * Class Constructor
	*/
	function __construct(){
		$this->wbg_actions = array();
		$this->wbg_filters = array();
	}

	function add_action( $hook, $component, $callback ){
		$this->wbg_actions = $this->add( $this->wbg_actions, $hook, $component, $callback );
	}

	function add_filter( $hook, $component, $callback ){
		$this->wbg_filters = $this->add( $this->wbg_filters, $hook, $component, $callback );
	}

	private function add( $hooks, $hook, $component, $callback ){
		$hooks[] = array( 'hook' => $hook, 'component' => $component, 'callback' => $callback );
		return $hooks;
	}

	public function wbg_run(){
		foreach( $this->wbg_filters as $hook ){
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
		foreach( $this->wbg_actions as $hook ){
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
	}
}
?>