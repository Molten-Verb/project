<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index() 
    {
        return view('currency');
    }

    public function exchangeCurrency(Request $request) {
        
        $amount = ($request->amount)?($request->amount):(1);
  
        $apikey = '4ef501401dd1b856cbf04748';
  
        $from_Currency = urlencode($request->from_currency);
        $to_Currency = urlencode($request->to_currency);
        
        $response_json = file_get_contents("https://v6.exchangerate-api.com/v6/{$apikey}/latest/{$from_Currency}");

        // Continuing if we got a result
        if(false !== $response_json) {
  
            // Try/catch for json_decode operation
            try {
  
                // Decoding
                $response = json_decode($response_json);
        
                // Check for success
                if('success' === $response->result) {
  
                    $final = $amount*$response->conversion_rates->{$to_Currency};
        
                    $query =  "{$amount} {$from_Currency} = {$final} {$to_Currency}";
                                
                    echo $query;
                }
  
            }
            catch(Exception $e) {
            // Handle JSON parse error...
            }
  
        }
      
    }

}
