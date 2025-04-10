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
$random_word;
$template;
$user_guess; 
$fails = 0;
$guessed_letters = array();

if(readline("Would you like to play Hangman?") == "Y"){
    play_round();
}



function play_round(){
    global $words, $random_word, $hangman_img;
    $random_word = $words[array_rand($words, 1)];
    echo $random_word, "\n";
    
    echo $random_word, "\n";
    // display first hangman image initially
    echo "$hangman_img[0]\n";
    
    while(true){
        //echo "Guess a letter: \n";
            make_guess();
            display_hangman();
            if(gameover()) break;
            //return true;
        //}
        //else break;
    } 
    echo "Thanks for playing!";
}
function make_guess(){
    // while loop 
    
    
    
    global $hangman_img, $random_word, $fails;
    
    
    ##### TESTING PURPOSES #####
    
    
    // for each letter in the randomly selected word, display "_"
    ###### change to $words to $random_word ######
    for($i = 0; $i <= strlen($random_word)-1; $i++){
        echo "_ ";
    } echo "\n"; // line break after displaying all underscores
    
    echo "Please guess a letter: ";
    $user_guess = readline();
    echo "User guessed: $user_guess \n";
    // if user guesses correctly, change letter display
    if (apply_guess($user_guess)){
         display_guessed_letter();
    }
    // otherwise, display the next hangman image
    else {
        $fails++;
        display_hangman();
    }
    //display_guessed_letter();
    // if guessed letter is in the word, tell user their guess is correct and prompt them to continue guessing
    // for each letter in $random_word, if i = $user_guess, replace the underscore with that letter
}

function display_hangman(){
    // if user guesses wrong, display the next value in $hangman_img
    // if $hangman_img[6] is displayed, game over
    global $hangman_img, $fails;
    // display hangman image at position of number of fails
    echo $hangman_img[$fails];
}

// displays updated state of game after user guesses a correct letter
function display_guessed_letter(){
    global $guessed_letters, $random_word, $template;
    $template = str_repeat(".", strlen($random_word));
    for($i=0; $i<=strlen($template)-1; $i++){
       if (in_array($random_word[$i], $guessed_letters)){
       	    //echo $word[$i], "\n";
            $template[$i] = $random_word[$i];
        }
    }
    echo $template;
}

function apply_guess($user_guess){
    //global $user_guess;
    global $guessed_letters, $random_word;
    $correct = false;
    $update = "";
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

function incorrect_guess(){
    // incorrect guesses variable (?)
    // if incorrect guesses == 6, game over
    // aka if $hangman_img[6] is displayed, game over
}

function gameover(){
    /* game over if:
        - user has 6 wrong guesses ($hangman_img[6] was printed)
        - user has guessed every letter correctly 
         */
    global $fails, $template, $random_word;
    // player loses if # of fails reaches 6
    if($fails == 6) return true;
    // player wins if their guesses match the random word
    if($template == $random_word) return true;
    return false;
}


?>
