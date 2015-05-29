<?php

require_once 'Vigenere.php';

// call Vigenere class, you may empty the parameter
$encryption = new Vigenere('rogerthat');

$plaintext = 'undur undur berjalan menyamping';
echo "Plain text: ".$plaintext."\n";

// start encrypt
$encryptionResult = $encryption->vigenere($plaintext);
echo "Encryption result: ".$encryptionResult."\n";

// start decrypt
$decryptionResult = $encryption->vigenere($encryptionResult, true);
echo "Decryption result: ".$decryptionResult."\n";
