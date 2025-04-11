<?php
// hangman game
// while user wants to keep playing, run game loop
// randomly pick from list of words when game starts
// prompt user to guess letters
// if user has 6 incorrect guesses, game ends
// if user guesses all letters correctly, ask if they want to play again

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

$words = ["SERVER", "GEORGIAN", "COMPUTER", "PROJECT"];
// word randomly picked from $words array
$random_word;
// underscores display for the number of letters there are in the random word
$template;
// when user gets to 6 failed guesses, the game ends
$fails = 0;
$user_guess;
$guessed_letters = array();

if(strtoupper(readline("Would you like to play Hangman?\nY for yes, N for no: ")) == "Y"){
    play_round();
    if(readline("Play again?\n") == "Y"){
        play_round();
    }
}

function play_round(){
    global $words, $random_word, $hangman_img;
    $random_word = $words[array_rand($words, 1)];
    echo $random_word, "\n";
    
    echo $random_word, "\n";
    // display first hangman image initially
    echo "$hangman_img[0]\n";
    
    // display this when game starts so user knows the number of letters in the word
    // for each letter in the randomly selected word, display "_"
    for($i = 0; $i <= strlen($random_word)-1; $i++){
        echo "_ ";
    } echo "\n\n";
    
    while(true){
        make_guess();
        //display_hangman();
        if(gameover()) break;
    } 
    echo "Thanks for playing!\n";
}
function make_guess(){
    global $hangman_img, $random_word, $fails;
    
    echo "Please guess a letter: ";
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
    global $guessed_letters, $random_word, $template;
    $template = str_repeat("_", strlen($random_word));
    for($i=0; $i<=strlen($template)-1; $i++){
       if (in_array($random_word[$i], $guessed_letters)){
       	    //echo $word[$i], "\n";
            $template[$i] = $random_word[$i];
        }
    }
    echo $template;
}

// this function displays the user's correct guesses so they know the position of their guessed letter in the word (e.g. "PR_J__T")
function apply_guess($user_guess){
    global $random_word, $guessed_letters;
    $correct = false;
    for($i = 0; $i <= strlen($random_word)-1; $i++){
        $letter = $random_word[$i];
        if($letter == $user_guess){
            $correct = true;
            array_push($guessed_letters, $letter);
            // replace "_" with guessed letter
            // return true;
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
    if($fails == 6) return true;
    // player wins if their guesses match the random word
    if($template == $random_word) return true;
    return false;
}

?>
