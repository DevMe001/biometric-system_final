<?php

namespace Biometric\BarcodeGenerator;

require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorSVG; // Use the SVG generator

class BarcodeReader
{
  public function generateBarcode($code, $width = 347, $height = 147)
  {
    $generator = new BarcodeGeneratorSVG(); // Use the SVG generator
    $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);

    // Modify the SVG markup to set the desired width and height
    $barcode = str_replace('<svg ', '<svg width="' . $width . '" height="' . $height . '" ', $barcode);

    // Output the modified SVG barcode directly
    echo $barcode;
  }
}

// Example usage
$barcodeReader = new BarcodeReader();
$barcodeReader->generateBarcode("123456789");
