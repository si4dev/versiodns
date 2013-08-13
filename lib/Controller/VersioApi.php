<?php

class Controller_VersioApi extends AbstractController {
    var $values;

    function init(){
        parent::init();
    }

    function send($data){
		######### VUL HIER UW GEGEVENS IN
		######### VUL HIER UW GEGEVENS IN
		######### VUL HIER UW GEGEVENS IN
		
        $klantId = $this->api->getConfig('clientId');
        $klantPw = $this->api->getConfig('clientPW');
		
		######### MAAK HIERONDER GEEN WIJZIGINGEN!
		######### MAAK HIERONDER GEEN WIJZIGINGEN!
		######### MAAK HIERONDER GEEN WIJZIGINGEN!

        $data["klantPw"] = $klantPw;
		$data["klantId"] = $klantId;

        $ch = curl_init("https://www.secure.versio.nl/api/api_server.php");
        curl_setopt($ch, CURLOPT_PORT , 443); 
        curl_setopt($ch, CURLOPT_POST , 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS , $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER , array('Connection: close'));
        curl_setopt($ch, CURLOPT_TIMEOUT , 120);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
        $response = curl_exec($ch);
        curl_close($ch);

        if ( $response == "" ) {
           $response = "success=0\nerror=100-000-000\nresponse_message=could not connect with server try again later";
        }

        $result = $this->ParseResponse( $response );

        return $result;
    }

	function NewRequest() {
		// Clear out all previous values
		$this->values = "";
	}

	function ParseResponse( $buffer ) {

        // Parse the string into lines
		$lines = explode( "\n", $buffer );
        $amount_lines = count ($lines);

		// Parse lines
		for($i = 0; $i < $amount_lines; $i++){

			// It is not, parse it
			$result = explode( "=", $lines[ $i ] );

			// Make sure we got 2 strings
			if ( count( $result ) >= 2 ){

				// Trim whitespace and add values
				$name = trim( $result[0] );
				$value = trim( $result[1] );
				$this->values[ $name ] = $value;
            }
        }

        return $this->values;
	}

}
