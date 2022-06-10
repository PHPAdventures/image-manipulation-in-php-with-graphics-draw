<?php
    if ( isset( $_GET['img'] ) ) {
        define('ASSET_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'assets');
        
        // Let the browser know this is an image, NOT a web page!
        header('Content-type: image/png');

        $string = 'PHP Adventures';
        $mainImage = imageCreateFromJPEG(ASSET_DIR . DIRECTORY_SEPARATOR . 'sailing-ship.jpeg');
        $watermarkImage = imageCreateFromPNG(ASSET_DIR . DIRECTORY_SEPARATOR . 'PHPAdventures-Watermark.png');
    
        // Place / paste one image on another...
        imageCopy(
            $mainImage,
            $watermarkImage,
            32, // Watermark X (from top-left.)
            32, // Watermark Y (from top-left.)
            0,  // Beginning of visible X of watermark.
            0,  // Beginning of visible Y of watermark.
            imagesX($watermarkImage), // End of visible X of watermark.
            imagesY($watermarkImage), // End of visible X of watermark.
        );

        $fontSize = 12;

        $fontColour = imageColorAllocate(
            $mainImage,
            255,
            255,
            255
        );

        $customFontPath = ASSET_DIR . DIRECTORY_SEPARATOR . 'georgia.ttf';

        // Add text (custom font) to the image.
        imageFTText(
            $mainImage,    // Where we want our text printed.
            $fontSize, // Size of font.
            7,         // Angle of text (in degrees.)
            28,        // X position of text (from top-left.)
            200,       // Y position of text (from top-left.)
            $fontColour,
            $customFontPath,
            $string
        );

        // Send image to browser.
        imageJPEG($mainImage);

        // Clean-up!
        imageDestroy($mainImage);
        imageDestroy($watermarkImage);

        exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GD Watermark</title>
</head>
<body>
    <h1>GD Watermark</h1>
    <img width="600" src="/04-gd-watermark-with-font.php?img=true" alt="Sailing Ship">
</body>
</html>