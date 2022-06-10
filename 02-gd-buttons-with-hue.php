<?php
    // Send back an image if we're receiving text for the button.
    if ( isset( $_GET['text'] ) ) {
        include
            __DIR__ .
            DIRECTORY_SEPARATOR .
            'includes' .
            DIRECTORY_SEPARATOR .
            'image-hue.php';

        define('ASSET_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'assets');
        
        // Let the browser know this is an image, NOT a web page!
        header('Content-type: image/png');

        $string = $_GET['text'];

        $image = imageCreateFromPNG(ASSET_DIR . DIRECTORY_SEPARATOR . 'button.png');

        // Font colour: white.
        $fontColour = imageColorAllocate(
            $image, // The image we want to get a colour ready for.
            255,    // RED
            255,    // GREEN
            255     // BLUE
        );

        $fontSize = 12;

        // Add the string to our image.
        imageString(
            $image,     // Which image do you want to print on?
            $fontSize,  // Size of font.
            2,          // X co-ordinate on the image (from top-left.)
            14,         // Y co-ordinate on the image (from top-left.)
            $string,    // Text to print on image.
            $fontColour // Colour of font.
        );

        // Adjust hue / colouration of image.
        imageHue($image, 200); // Image, and hue shift in degrees (0-360.)

        // Allow alpha channels (transparency) in image.
        imageSaveAlpha($image, TRUE);

        // Sends the image.
        imagePNG($image);

        // Good practice to get rid of it.. (PHP is usually good at this on its own!)
        imageDestroy($image);

        exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01 GD Buttons</title>
</head>
<body>
    <h1>01 GD Buttons</h1>
    <p>
        <a href="https://phpadventures.com">
            <img src="/02-gd-buttons-with-hue.php?text=PHP+Adventures" alt="PHP Adventures">
        </a>
        <a href="https://www.bioware.com/">
            <img src="/02-gd-buttons-with-hue.php?text=BioWare" alt="BioWare">
        </a>
    </p>
    
</body>
</html>