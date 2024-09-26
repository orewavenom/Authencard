<?php 

use Ofcold\QrCode\Facades\QrCode;
use Ofcold\QrCode\HexToRgb;

require "vendor/autoload.php";



$text = 'Happy New Year';

// Default output svg format file.
QrCode::generate($text);

 ?>