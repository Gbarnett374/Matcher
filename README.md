#String Finder 

Requires PHP 5.4 or greater. 
CLI PHP Program that reads a CSV file as input and outputs the strings that appear as a pair on the same line of the CSV. The output is based on a threshold set on the first line of the CSV.

Input Format
The first line contains an integer, the minimum number of co-occurrences/threshold for a pair of strings to appear in the output. Subsequent lines are comma-separated lists of strings. 

Output 
Pairs of strings, separated by a comma, that appeared together on at least the threshold number of lines in the input. A pair will appear exactly once, and the pair of strings will be listed in alphabetical order. 

Example Input<br>
3<br>
Orange,Apple,Banana<br>
Pear,Pineapple,Banana<br>
Orange,Apple,Avocado<br>
Cherry,Pineapple,Apple,Avocado,Lemon<br>
Pear,Cherry,Avocado<br>
Pear,Cherry,Orange,Lemon,Banana<br>
Orange,Apple,Avocado<br>
Pineapple,Apple,Avocado<br>
Pear,Cherry,Orange<br>
Pear,Orange,Lemon<br>

Example Output<br>
Apple,Avocado<br>
Apple,Orange<br>
Cherry,Pear<br>
Orange,Pear<br>

Example Explanation
Since the first line of the input reads, 3, the output must only show those strings which appear together in a at least 3 lines of the file. There are exactly 4 pairs of strings that appear together at least 3 times in the input.

To run from terminal:

php matcher_controller.php < input_file.txt