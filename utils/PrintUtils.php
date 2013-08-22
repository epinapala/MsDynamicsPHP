<?php

/*
 * @author
 * Eswar Rajesh Pinapala | epinapala@live.com
 */

/**
 * Description of PrintUtils
 * COntains all the util functions for 
 * printing logs and messages.
 * @author epinapala
 */
class PrintUtils {

    public static function dump($d, $halt = 0) {
        print "<pre>" . print_r($d,true) . "</pre>";
        if($halt){
            die("Halted ...");
        }
    }

}

?>
