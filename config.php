<?php
    // For XHR Requests
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    
    // CONSTANTS
    define("STATES", json_encode(["AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware", "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland", "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming"]));
    define("API_BASE_URL","https://secure.shippingapis.com/ShippingAPI.dll?");
    define("API_ACCOUNT_ID","484NA0005217");
    define("DEBUG",TRUE);
    
    define("DB_HOST", "localhost");
    define("DB_NAME", "address_validator");
    define("DB_USER", "root");
    define("DB_PASS", "root");

    // ERROR REPORTING
    if(DEBUG)
    {
        ini_set("display_errors",TRUE);
        error_reporting(E_ALL);
    }
    else
    {
        ini_set("display_errors",FALSE);
        error_reporting(0);
    }
    
    // COMMON FUNTIONS
    require_once("functions.php");
    $Utility = new Utility(API_BASE_URL, DB_HOST, DB_NAME, DB_USER, DB_PASS);