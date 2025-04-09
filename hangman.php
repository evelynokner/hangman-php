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
$random_word; $user_guess;
$guessed_letters = array();

if(readline("Would you like to play Hangman?") == "Y"){
    play();
}

while(true){
    //echo "Guess a letter: \n";
        play();
        //return true;
    //}
    //else break;
} 
echo "Thanks for playing!";

function play(){
    global $hangman_img, $words, $random_word;
    $random_word = $words[array_rand($words, 1)];
    
    ##### TESTING PURPOSES #####
    echo $random_word, "\n";
    echo "$hangman_img[0]\n";
    
    // for each letter in the randomly selected word, display "_"
    ###### change to $words to $random_word ######
    for($i = 0; $i <= strlen($random_word)-1; $i++){
        echo "_ ";
    } echo "\n"; // line break after displaying all underscores
    
    echo "Please guess a letter: ";
    $user_guess = readline();
    echo "User guessed: $user_guess \n";
    apply_guess($user_guess);
    display_guessed_letter();
    // if guessed letter is in the word, tell user their guess is correct and prompt them to continue guessing
    // for each letter in $random_word, if i = $user_guess, replace the underscore with that letter
}

function display_hangman(){
    // if user guesses wrong, display the next value in $hangman_img
    // if $hangman_img[6] is displayed, game over
}

// displays updated state of game after user guesses a correct letter
function display_guessed_letter(){
    global $guessed_letters, $random_word;
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



?>
