<?php 

require './stringFinderClass.php';
try{
    //Read the STDIN 
    $input = fopen('php://stdin', 'r');
    $stringFinder = new stringFinder($input);

    $stringFinder->setThreshold();
    $stringFinder->setUniqueStrings();
    $stringFinder->qualifies();
    $stringFinder->determinePermutations();
    $stringFinder->setOutput();
    $output = $stringFinder->returnOutput();
    //Close the input stream. 
    fclose($input);
    //Output to SDOUT
    fwrite(STDOUT, $output);
} catch(Exception $e) {
    //Close the input stream. 
    fclose($input);
    //Output to SDOUT
    fwrite(STDOUT, $e->getMessage());
}