<?php

function Head($title = 'Bill Splitter')
{
    echo "
    <!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../assets/css/reset.css'>
            <link rel='stylesheet' href='../assets/css/index.css'>
            <title>$title</title>
        </head>
    
        <body>";
}
