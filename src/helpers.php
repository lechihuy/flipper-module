<?php

use Flipper\Module\PackageServiceProvider as Module;

if (! function_exists('module_path')) {
    function module_path($path = null) {
        return rtrim(base_path(Module::PREFIX_MODULE_NAME . "/$path"), '/');
    }
}