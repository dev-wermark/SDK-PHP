<?php
final class Load {

    private static $rute_app_core;

    public static function autoLoad() {

        $dir = __DIR__;
        $part = explode('wermark-sdk/src/', $dir);

        $tam_part = count($part);

        if ($tam_part > 1) {
            $rute = $part[0].'wermark-sdk/src/';
        } else {

            //Windows
            $part = explode('wermark-sdk\src\\', $dir);
            $rute = $part[0].'wermark-sdk\src\\';

        }

        self::$rute_app_core = $rute;

        spl_autoload_register(function($file) {

            $trait_file = self::$rute_app_core.'traits/trait.'.strtolower($file).'.php';
            $class_file = self::$rute_app_core.'class/class.'.strtolower($file).'.php';

            if (file_exists($class_file)) {
                require_once($class_file);
            } else if (file_exists($trait_file)) {
                require_once($trait_file);
            }

        });

    }

}
?>