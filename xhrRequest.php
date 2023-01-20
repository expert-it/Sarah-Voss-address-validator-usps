<?php
    require_once("config.php"); 
    try
    {
        // CHECK POST INPUTS
        $post = file_get_contents("php://input");
        if($post != "")
        {
            $post = json_decode($post, true);
            switch ($post['action'])
            {   
                case 'validate_address':
                    // Address Validation
                    $REQUEST_ADDRESS = 'API=Verify&XML='.urlencode('<AddressValidateRequest USERID="'.API_ACCOUNT_ID.'"><Address><Address1>'.$post['addressline1'].'</Address1><Address2>'.$post['addressline2'].'</Address2><City>'.$post['addresscity'].'</City><State>'.$post['addressstate'].'</State><Zip5>'.$post['addresszipcode'].'</Zip5><Zip4></Zip4></Address></AddressValidateRequest>');
                    $REQUEST_URL = $REQUEST_ADDRESS;
                    $request = $Utility->validateRequest($REQUEST_URL, "GET");
                    if(@isset($request['Address']['Error']['Description']))
                    {
                        $response = [ "status" => 500, 'address' => [], 'message' => $request['Address']['Error']['Description']];
                    }
                    elseif(@$request['Address']['ReturnText'] != "")
                    {
                        $response = [ "status" => 500, 'address' => $request['Address'], 'message' => $request['Address']['ReturnText']];
                    }
                    else
                    {   
                        $message="<p>Which address format you want to save?</p>
                                <nav>
                                    <div class='nav nav-tabs' id='nav-tab' role='tablist'>
                                        <button class='nav-link text-uppercase active' id='original-address' data-bs-toggle='tab' data-bs-target='#nav-original-address' type='button' role='tab' aria-controls='nav-original-address' aria-selected='true'>Original</button>
                                        <button class='nav-link text-uppercase' id='usps-address' data-bs-toggle='tab' data-bs-target='#nav-usps-address' type='button' role='tab' aria-controls='nav-usps-address' aria-selected='false'>Standardized (USPS)</button>
                                    </div>
                                </nav>";
                        $message.="<div class='tab-content' id='nav-tabContent'>
                                        <div class='tab-pane fade show active' id='nav-original-address' role='tabpanel' aria-labelledby='original-address' tabindex='0'>";
                                        $message.="<ul class='list-group'>";
                                            $message.="<li class='list-group-item'>Address1: ".$post['addressline1']."</li>";
                                            $message.="<li class='list-group-item'>Address2: ".$post['addressline2']."</li>";
                                            $message.="<li class='list-group-item'>City: ".$post['addresscity']."</li>";
                                            $message.="<li class='list-group-item'>State: ".$post['addressstate']."</li>";
                                            $message.="<li class='list-group-item'>Zip Code: ".$post['addresszipcode']."</li>";
                                        $message.="<ul>";
                            $message.="</div>
                                        <div class='tab-pane fade' id='nav-usps-address' role='tabpanel' aria-labelledby='usps-address' tabindex='0'>";
                                        $message.="<ul class='list-group'>";
                                        foreach ($request['Address'] as $key => $value)
                                        {
                                            $message.="<li class='list-group-item'>$key: $value</li>";
                                        }
                                    $message.="<ul>";
                            $message.="</div>
                                </div>";
                        $response = [ "status" => 200, 'original_address' => $post, 'formated_address' => $request['Address'], 'message' => $message];    
                    }
                break;
                case 'save_address':
                    if($Utility->saveAddress($post))
                    {
                        $response = [ "status" => 200, 'address' => [], 'message' =>  "Address Saved Successfully."];
                    }
                    else{
                        $response = [ "status" => 503, 'address' => [], 'message' =>  "Error While Saving Address."];
                    }
                    
                break;
                default:
                    $response = [ "status" => 400, 'address' => [], 'message' =>  "BAD REQUEST"];
                break;
            }
        }
    }
    catch (Exception $e)
    {
        $response = [ "status" => 500, 'address' => [], 'message' =>  $e->getMessage()];
    }
    echo json_encode($response); exit;
?>