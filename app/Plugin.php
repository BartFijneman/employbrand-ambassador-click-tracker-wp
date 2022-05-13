<?php

namespace EmploybrandAmbassador;

use Carbon_Fields\Carbon_Fields;
use EmploybrandAmbassador\Listener\Tracker;


class Plugin {

    public function __construct()
    {
        add_action( 'after_setup_theme', [$this, 'loadCarbon'] );

        /*
         * Register listeners
         */
        Tracker::register();
    }


    function loadCarbon() {
        Carbon_Fields::boot();
    }

}
