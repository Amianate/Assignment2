<?php

// Register the autoloader
spl_autoload_register('autoload');

function autoload($className)
{    
    // Define an array of directories to search for the class
    // $directories = [
    // //    '/',  // Root directory
    //    '/400003165/app/controller', // Controller directory
    //    '/400003165/framework', // Framework directory
    // ];

    $namespaces = [
        'framework' => __DIR__ . '/../framework/',
        'app\controller'=> __DIR__ . '/../app/controller/',
        'config' => __DIR__ 
    ];

    // Convert class name to file path
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    foreach($namespaces as $namespace => $path){

        if (strpos($className, $namespace) === 0) {
        $fullPath = $path . substr($filePath, strlen($namespace) + 1);
        // echo "filePath: ".$fullPath.'<br>';
        
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }

    // // Iterate through the directories
    // foreach ($directories as $directory) {
    //     $fullPath = $directory . '/' . $filePath;
    //     echo $fullPath . "<br>";
    //     // Check if the file exists
    //     if (file_exists($fullPath)) {
    //         // Require the file
    //         require_once $fullPath;
    //         return; // Stop searching once the file is found
    //     }
    // }
}

}
// // Define the base directories for each namespace
// $namespaceDirectories = [
//     'web' => '/wamp64/www/web/',
//     // 'web'=> '/xampp/htdocs/web/'
// ];

// // Convert namespace seperators to directory separators
// $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
// $classPath = $className . '.php';
// // echo $classPath . '<br />';

// // Check if the class belongs to one of the specified namespaces
// foreach ($namespaceDirectories as $namespace => $directory) {
//     if (strpos($className, $namespace) === 0) {
//         $filePath = $directory . substr($classPath, strlen($namespace) + 1);
//         // echo "filePath".$filePath.'<br>';
//         if (file_exists($filePath)) {
//             require_once $filePath;
//             return;
//         }
//     }
// }

// // If the class doesn't belong to any specified namespace, construct the file path using the base directory
// $filePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . $classPath;
// // echo "filePath".$filePath.'<br>';
// if (file_exists($filePath)) {
//     require_once $filePath;
//     return;
// }
