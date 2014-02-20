<?php

/**
 * DogeAPI v2 Wrapper
 * 
 * Requirements: PHP (v5.3+), cURL
 * 
 * @author Steven Hooley <steven@hooley.me> -- Original by Jackson Palmer
 */
 
class DogeAPIv2
{    
    private $api_key;
    
    //Set API Key to Non-Valid
    private $valid_key = false;
   
    //Build cURL Request Driver
    private function _request($method, $path, $vars = array(), $api_key=true)
    {
        //Put together the URL for cURL Requests
        if($api_key==true) $url =  'https://www.dogeapi.com/wow/v2/?api_key=' . $this->api_key . $path . '&dev=03kdkj94kfj39slk4';
        else $url =  'https://www.dogeapi.com/wow/v2/?a=' . $path;

        // Check for vars and build query string
        if (!empty($vars)) {
            $url .= '&' . http_build_query($vars);
        }

        //Initiate cURL
        $c  = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        
        //set header content type to JSON
        curl_setopt($c, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        
        //Set cURL options
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $res = curl_exec($c);
        curl_close($c);

        //Get reponse, or FAIL
        return $res ? json_decode($res) : false;        
    }

    /**
    * API Key Functions - Set, Get, and Validate
    */
    public function set_key($k)
    {
        $this->api_key = $k;
        return $this->validate_key();
    }

    public function get_key($k)
    {
        return $this->api_key;
    }

    private function validate_key()
    {
        // Test if the key is valid by doing a simple balance check
        $validate = $this->_request('GET', '&a=get_balance');
        
        // Return true/false if key is valid
        if ($validate == "Invalid API Key")
            $this->valid_key = false;
        else
            $this->valid_key = true;
        return $this->valid_key;
    }

    /**
     * Main Functons (DogeAPI v2 abstraction layer)
     */
     
    //create new user
    public function create_user($vars = array())
    {
        return $this->_request('GET', '&a=create_user', $vars);
    }
    
    //get users associated with API key
    public function get_users()
    {
        return $this->_request('GET', '&a=get_users');
    }
    
    //get address assigned to user id
    public function get_user_address($vars = array())
    {
        return $this->_request('GET', '&a=get_user_address', $vars);
    }
    
    // get_balance
    public function get_balance()
    {
        return $this->_request('GET', '&a=get_balance');
    }
    
    //get the users balance
    public function get_user_balance($vars = array())
    {
        return $this->_request('GET', '&a=get_user_balance', $vars);
    }

    // withdraw
    public function withdraw($vars = array())
    {
        return $this->_request('GET', '&a=withdraw', $vars);
    }
    
    //withdraw from user
    public function withdraw_from_user($vars = array())
    {
        return $this->_request('GET', '&a=withdraw_from_user', $vars);
    }
    
    // get_new_address
    public function get_new_address($vars = array())
    {
        return $this->_request('GET', '&a=get_new_address', $vars);
    }
    
    //move doge to another user (in network transaction)
    public function move_to_user($vars = array())
    {
        return $this->_request('GET', '&a=move_to_user', $vars);
    }

    // get_my_addresses
    public function get_my_addresses()
    {
        return $this->_request('GET', '&a=get_my_addresses');
    }

    // get_address_received
    public function get_address_received($vars = array())
    {
        return $this->_request('GET', '&a=get_address_received', $vars);
    }

    // get_address_by_label
    public function get_address_by_label($vars = array())
    {
        return $this->_request('GET', '&a=get_address_by_label', $vars);
    }

    // get_difficulty
    public function get_difficulty()
    {
        return $this->_request('GET', '&a=get_difficulty');
    }

    // get_current_block
    public function get_current_block()
    {
        return $this->_request('GET', '&a=get_current_block');
    }   

    // get_current_price
    public function get_current_price($api_key=false)
    {
        return $this->_request('GET', '&a=get_current_price');
    }
    // get network hashrate
    public function get_network_hashrate($api_key=false)
    {
        return $this->_request('GET', '&a=get_network_hashrate');
    }
    
    //get information on usd/btc, block count, difficulty, 5 min price change, hashrate, and API ver.
     public function get_info($api_key=false)
    {
        return $this->_request('GET', '&a=get_info');
    }
    
}
?>
