<?php
require_once 'lib/dogeapi.php';

$dogeAPIKey = "INSERTAPIKEYHERE";

$doge = new DogeAPI();

$validKey = $doge->set_key($dogeAPIKey);

if($validKey) {
	echo "Yay, it's a valid API key\n\n";
	$balance = $doge->get_balance();
	$address = $doge->get_my_addresses();
	$difficulty = $doge->get_difficulty();
	$current_block = $doge->get_current_block();
	echo "Your current balance is " . $balance . "Ɖ\n";
	echo "Your current address is " . print_r($address,true) . "\n";
	echo "The current difficulty is " . $difficulty . "\n";
	echo "The current block is " . $current_block . "\n";
} else {
  echo "The API Key (" . $doge->get_key() . ") is not a valid API key";
}
?>