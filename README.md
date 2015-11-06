#String Finder 

Requires PHP 5.4 or greater. 
CLI PHP Program that reads a CSV file as input and outputs the strings that appear as a pair on the same line of the CSV. The output is based on a threshold set on the first line of the CSV.

Input Format
The first line contains an integer, the minimum number of co-occurrences/threshold for a pair of strings to appear in the output. Subsequent lines are comma-separated lists of strings. 

Output 
Pairs of strings, separated by a comma, that appeared together on at least the threshold number of lines in the input. A pair will appear exactly once, and the pair of strings will be listed in alphabetical order. 

Example Input
3
Orange,Apple,Banana
Pear,Pineapple,Banana
Orange,Apple,Avocado
Cherry,Pineapple,Apple,Avocado,Lemon
Pear,Cherry,Avocado
Pear,Cherry,Orange,Lemon,Banana
Orange,Apple,Avocado
Pineapple,Apple,Avocado
Pear,Cherry,Orange
Pear,Orange,Lemon

Example Output
Apple,Avocado
Apple,Orange
Cherry,Pear
Orange,Pear

Example Explanation
Since the first line of the input reads, 3, the output must only show those strings which appear together in a at least 3 lines of the file. There are exactly 4 pairs of strings that appear together at least 3 times in the brand view log input.

To run from terminal:

php matcher_controller.php < input_file.txt