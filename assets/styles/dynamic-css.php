<?php
header("Content-type: text/css; charset: UTF-8");

require_once get_template_directory().'/functions/scssphp/scss.inc.php';
use ScssPhp\ScssPhp\Compiler;
$scss = new Compiler();
echo $scss->compile('$body-font-size: 20px;
body {
  font-size: $body-font-size;
}
');


