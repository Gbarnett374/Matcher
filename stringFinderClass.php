<?php
Class stringFinder
{
    protected $input;
    protected $threshold;
    protected $uniqueStrings = [];
    protected $permutations = [];
    protected $output;

    function __construct($input)
    {   
        if (is_resource($input)) {
            $this->input = $input;
        } else{
            throw new Exception("Invalid input.\n");       
        }
    }
/**
 * Grabs the first line of the input file & sets the threshold in which a pair of strings qualify.
 */
    function setThreshold()
    {   
        if ($line = fgetcsv( $this->input )){
            //Make sure the threshold is an integer and not 0.
            if (is_numeric($line[0]) && $line[0] != 0 && !strpos($line[0],'.')) {
                $this->threshold = $line[0];
            }
            else{
                throw new Exception("Threshold must be an integer & greater then 0.\n");
            }
        } else {
            throw new Exception("Error Reading input.\n");        
        }
    }
/**
 * Creates a unique array of all the strings in the file and how many times they appear. 
 */
    function setUniqueStrings()
    {
        //Set pointer of the file to the 2nd line 
        fseek($this->input ,2);
        while( $line = fgetcsv( $this->input ) ) {
            //loop through each col in the line and push to a new array. 
            for ($i = 0; $i < count($line); $i++) {
                //Check to make sure there is not a blank line.
                if (!empty($line[$i])) {
                    array_push($this->uniqueStrings, $line[$i]);
                }
            }
        }
        //We will now have an array of how many times a each individual string has appeared in the file.
        $this->uniqueStrings = array_count_values($this->uniqueStrings);
    }
/**
 * Compares the threshold with the value of occurances for each string and removes strings that do not qualify. 
 *
 */
    function qualifies()
    {
        foreach ($this->uniqueStrings as $k => $v) {
            if ($v < $this->threshold) {
                unset($this->uniqueStrings[$k]);
            }
        }
        if(empty($this->uniqueStrings)) {
            throw new Exception("There are no possible co-occurances since none of the strings in the file qualfiy based on the threshold.\n");      
        }
    }
/**
 * Determines all the possbile permutations and saves them to an array. 
 */
    function determinePermutations()
    {
        //Sort keys Alphabetically 
        ksort($this->uniqueStrings);

        foreach ($this->uniqueStrings as $k => $v) {
            foreach ($this->uniqueStrings as $k2 => $v2) {
                if ($k == $k2) {
                    continue;
                }
                if (!in_array($k . "," . $k2, $this->permutations) && !in_array($k2 . "," . $k, $this->permutations)) {
                    array_push($this->permutations, $k . "," . $k2);
                }
            }
        }
    }
/**
 * Determines the co-occurances/matches in the correct order and sets the output.
 */
    function setOutput()
    {
        //Each position of $this->permutations array contains a string with a pair of strings from the file. 
        foreach ($this->permutations as $pair) {
            //Set pointer in the file to line 2. 
            fseek($this->input, 2);
            //Reset occurance count after threshold for the co-occurance has been meet. 
            $occurence_count = 0;
            //Explode strings using a comma, and find how many times each appears on the same line.
            $pair_array = explode(',', $pair);
            //read file line by line starting at line 2 and compare the strings in the $pair array with what is in the file. 
            while( $line = fgetcsv( $this->input ) ) {
                if (in_array($pair_array[0], $line) && in_array($pair_array[1], $line)) {
                    $occurence_count++;
                    if($occurence_count >= $this->threshold){
                        $this->output .= $pair_array[0] . "," . $pair_array[1] . "\n";
                        //Threshold has been meet for this pair. Add to output and break the inner loop to continue onto the next pair.
                        break;
                    }
                }
            }
        }
    }
    /**
     * Returns the output.
     * @return string
     */
    function returnOutput()
    {
        if (!empty($this->output)) {
            return $this->output;
        } else {
            throw new Exception("It looks like there are no results based on the threshold.\n");
        }
    }
} //End class. 