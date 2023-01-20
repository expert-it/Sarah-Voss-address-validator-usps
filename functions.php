<?php 

class Utility
{

    private $baseUrl;
    private $dbConnection;
    

	public function __construct($API_BASE_URL, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
	{
		$this->baseUrl = $API_BASE_URL;
        $this->dbConnection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	}

    // Curl Request 
    public function validateRequest($REQUEST_URL, $REQUEST_METHOD)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $this->baseUrl.$REQUEST_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $REQUEST_METHOD);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output=curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch))
        {    
            $error_msg = curl_error($ch);
            $error_no = curl_errno($ch);
            print_r($http_status); die($error_no." :: ".$error_msg);
        }
        curl_close($ch);
        return json_decode(json_encode(simplexml_load_string($output)),TRUE);
    }

    // Save Address
    public function saveAddress($address){
        if($address['address_type'] == "formatted")
        {
            $address1 = $address['address']['Address1'];
            $address2 = $address['address']['Address2'];
            $city     = $address['address']['City'];
            $state    = $address['address']['State'];
            $zipcode  = $address['address']['Zip5'];
        }
        else
        {
            $address1 = $address['address']['addressline1'];
            $address2 = $address['address']['addressline2'];
            $city     = $address['address']['addresscity'];
            $state    = $address['address']['addressstate'];
            $zipcode  = $address['address']['addresszipcode'];
            unset($address['action']);
        }
        $response     = json_encode($address);
        $address_type = $address['address_type'];
        $created_at   = date("Y-m-d H:i:s");
        $query = "INSERT INTO validated_address (address1, address2, city ,state, zipcode, address_type, response, created_at) VALUES ('$address1', '$address2', '$city' , '$state', '$zipcode', '$address_type', '$response', '$created_at')";
        if ($this->dbConnection->query($query) === TRUE)
            return true;
        return false;

        // echo "Error: $query<br>"; die;
        // $this->dbConnection->error;
    }

    public function __destruct()
    {
        $this->dbConnection->close();   
    }
}