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
$random_word, $user_guess;

while(true){
    if(readline("Would you like to play hangman?\n") == "y"){
        play();
        return true;
    }
    else return false;
}

function play(){
    global $hangman_img, $words, $random_word;
    ##### TESTING PURPOSES #####
    echo "$hangman_img[0]\n";
    // for each letter in the randomly selected word, display "_"
    ###### change to $words to $random_word ######
    for($i = 0; $i <= strlen($words[0])-1; $i++){
        echo "_ ";
    } echo "\n"; // line break after displaying all underscores
    
    echo "$words[0]\n";
    echo "Please guess a letter: ";
    $user_guess = readline();
    echo "User guessed: $user_guess";
    // if guessed letter is in the word, tell user their guess is correct and prompt them to continue guessing
    // for each letter in $random_word, if i = $user_guess, replace the underscore with that letter
}

function display_hangman(){
    // if user guesses wrong, display the next value in $hangman_img
}


?>
