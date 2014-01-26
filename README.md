DogeAPI PHP
===========

PHP wrapper for [DogeAPI.com](https://www.dogeapi.com/) for use with [Dogecoin](http://dogecoin.com/). API key validation on instantiation, simple abstraction layer on top of existing API interfaces, and automatic JSON decoding on response.

Pull requests accepted and encouraged. :)

### Usage

First, sign up for an account at [DogeAPI.com](https://www.dogeapi.com/) and take note of your API key under Account > Settings

Download and include the dogeapi.php class:

~~~
require_once 'path/to/dogeapi.php';
~~~

Or preferably install via [Composer](https://getcomposer.org/)

~~~
"dogeapi-php/dogeapi-php": "dev-master"
~~~

Instantiate the class and set your API key. If the API key is valid the set function will return true otherwise false.

~~~
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
~~~

The wrapper abstracts all methods listed at https://www.dogeapi.com/api_documentation using the same interface names. For example, to get your current account balance:

~~~
$balance =  $doge->get_balance();
echo $balance;
~~~

To make requests that require parameters (eg. an address label or address to withdraw to), pass through each parameter in an associative array. For example, the request below will withdraw 50 DOGE to the wallet you specify in place of `WALLET-ADDRESS-HERE`:

~~~
$withdraw = $doge->withdraw(array('amount' => 50, 'payment_address' => 'WALLET-ADDRESS-HERE'));
~~~

**Note:** Error checking has not been fully implemented, please enforce your own checks on top of the wrapper. 

### Other Examples

#### Set Current API Key

Set the current API key being used. The key is also validated and the result of this validation is returned.

~~~
$validKey = $doge->set_key($dogeAPIKey);
if($validKey) {
	echo "Yay, it's a valid API key\n\n";
} else {
  echo "The API Key (" . $doge->get_key() . ") is not a valid API key";
}
~~~

#### Get Current API Key

Print the current API key being used

~~~
echo $doge->get_key();
~~~

#### Get Balance

Print the current balance of your account.

~~~
echo $doge->get_balance();
~~~

#### Get My Addresses

Print an array of wallet addresses associated with your account:

~~~
$addresses = $doge->get_my_addresses();
print_r($addresses);
~~~

#### Get the Current Block

Print the current block the blockchain has reached:

~~~
echo $doge->get_current_block();
~~~