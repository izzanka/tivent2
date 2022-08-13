<?php 

function convertImages($images)
{
    $arrayImages = json_decode($images);
    $stringImages = implode($arrayImages);
    $idImages = preg_replace('/[^a-zA-Z]/', '', $stringImages);

    return [$arrayImages,$idImages];
}