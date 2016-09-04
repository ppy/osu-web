<?php

/**
 * Laravel - A PHP Framework For Web Artisans.
 *
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
return ($uri !== '/' and file_exists(__DIR__.'/public'.$uri));
  

require_once __DIR__.'/public/index.php';
