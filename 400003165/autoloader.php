<?php

// Register the autoloader
spl_autoload_register('autoload');

function autoload($className)
{
    // Define an array of directories to search for the class
    $directories = [
        __DIR__ . '/../app/controller', // Controller directory
    ];

    // Convert class name to file path
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    // Iterate through the directories
    foreach ($directories as $directory) {
        $fullPath = $directory . '/' . $filePath;

        // Check if the file exists
        if (file_exists($fullPath)) {
            // Require the file
            require_once $fullPath;
            return; // Stop searching once the file is found
        }
    }
}

