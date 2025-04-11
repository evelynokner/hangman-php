<?php
/* HANGMAN GAME
   while user wants to keep playing, run game loop
   randomly pick from list of words when game starts
   prompt user to guess letters
   if user has 6 incorrect guesses, game ends
   if user guesses all letters correctly, game ends
   when game ends, ask user if they want to play again 
*/

$hangman_img = ["
   +---+
       |
       |
       |
      ===", "
   +---+
   O   |
       |
       |
      ===", "
   +---+
   O   |
   |   |
       |
      ===", "
   +---+
   O   |
  /|   |
       |
      ===", "
   +---+
   O   |
  /|\  |
       |
      ===", "
   +---+
   O   |
  /|\  |
  /    |
      ===", "
   +---+
   O   |
  /|\  |
  / \  |
      ==="];

// list of words that will be randomly picked and stored in $random_word
$words = ["SERVER", "GEORGIAN", "COMPUTER", "PROJECT"];
$random_word;
// underscores display for the number of letters there are in the random word
$template;
// when user gets to 6 failed guesses, the game ends
$fails = 0;
$user_guess;
$guessed_letters = array();

// when user first runs program, ask if they want to play
if(strtoupper(readline("Would you like to play Hangman?\nY for yes, N for no: ")) == "Y"){
    play_round();
    // when game ends, ask user if they wish to play again
    if(strtoupper(readline("Play again?\n")) == "Y"){
        play_round();
    }
}

function play_round(){
    global $words, $random_word, $hangman_img;
    $random_word = $words[array_rand($words, 1)];
    
    // for testing purposes to check what the random word is
    //echo $random_word, "\n";
    
    // display first hangman image initially
    echo "$hangman_img[0]\n";
    
    // display this when game starts so user knows the number of letters in the word
    // for each letter in the randomly selected word, display "_"
    for($i = 0; $i < strlen($random_word); $i++){
        echo "_ ";
    } echo "\n\n";
    
    while(true){
        // user can keep guessing while loop runs
        make_guess();
        // if gameover is true, end game
        if(gameover()) break;
    } 
    echo "Thanks for playing!\n";
}

function make_guess(){
    global $hangman_img, $random_word, $fails;
    
    echo "\nPlease guess a letter: ";
    // allow user to type in lowercase letters and they will convert to uppercase
    $user_guess = strtoupper(readline());
    
    // if user guesses correctly, change letter display
    if (apply_guess($user_guess)){
        echo $user_guess, " is correct!\n\n";
        display_guessed_letter();
    }
    // if user guesses wrong, display the next hangman image
    else {
        echo "Sorry, ", $user_guess, " is not in the word.\n";
        $fails++;
        display_hangman();
    }
}

function display_hangman(){
    // if user guesses wrong, display the next value in $hangman_img
    // if $hangman_img[6] is displayed, game over
    global $hangman_img, $fails;
    // display hangman image at position of number of fails
    echo $hangman_img[$fails], "\n";
}

// displays updated state of game after user guesses a correct letter
function display_guessed_letter(){
    global $random_word, $template, $guessed_letters;
    // template is a string of underscores for the number of letters in the random word
    $template = str_repeat("_", strlen($random_word));
    // iterate through length of template
    for($i = 0; $i < strlen($template); $i++){
        // check if a guessed letter is in the random word
        if(in_array($random_word[$i], $guessed_letters)){
            // replace the underscore with the correctly guessed letter
            $template[$i] = $random_word[$i];
        }
    }
    echo $template;
}

// this function displays the user's correct guesses so they know the position of their guessed letter in the word (e.g. "PR_J__T")
function apply_guess($user_guess){
    global $random_word, $guessed_letters;
    $correct = false;
    // iterate through the word and see if the guessed letter matches a letter in the word
    for($i = 0; $i < strlen($random_word); $i++){
        $letter = $random_word[$i];
        // if the user's guessed letter matches a letter in the random word, set $correct to true
        if($letter == $user_guess){
            $correct = true;
            // add the correctly guessed letter to the array of guessed letters
            array_push($guessed_letters, $letter);
        }
    }
    return $correct;
}

// determines if game is over, returns boolean
function gameover(){
    /* game over if:
        - user has 6 wrong guesses ($hangman_img[6] was printed)
        - user has guessed every letter correctly 
    */
    global $fails, $template, $random_word;
    
    // player loses if number of fails reaches 6
    if($fails == 6){
        echo "\nSorry, you lost. ";
        return true;
    }
    // player wins if their guesses match the random word
    if($template == $random_word){
        echo "\nCongrats, You won! ";
        return true;
    }
    return false;
}

?>
