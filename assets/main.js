let AddressResponse;
function validateAddress(event){
    event.preventDefault();
    let addressline1    = document.getElementById("addressline1").value;
    let addressline2    = document.getElementById("addressline2").value;
    let addresscity     = document.getElementById("addresscity").value;
    let addressstate    = document.getElementById("addressstate").value;
    let addresszipcode  = document.getElementById("addresszipcode").value;
    
    if(addressline1 == "")
    {
        document.getElementById("message").innerHTML = "Please Enter Address1";
        return false;
    }
    else if(addressline2 == "")
    {
        document.getElementById("message").innerHTML = "Please Enter Address2";
        return false;
    }
    else if(addresscity == "")
    {
        document.getElementById("message").innerHTML = "Please Enter City";
        return false;
    }
    else if(addressstate == "")
    {
        document.getElementById("message").innerHTML = "Please Select State";
        return false;
    }
    else if(addresszipcode == "")
    {
        document.getElementById("message").innerHTML = "Please Enter Zip Code";
        return false;
    }
    else
    {
        document.getElementById("submitbutton").disabled = true; 
        document.getElementById("message").innerHTML = "Please wait...";
    }
    setTimeout(function ()
    {
        let params = JSON.stringify({'action':'validate_address', 'addressline1':addressline1, 'addressline2':addressline2, 'addresscity':addresscity, 'addressstate':addressstate, 'addresszipcode':addresszipcode});
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                let response = JSON.parse(this.responseText);
                document.getElementById("message").innerHTML = "";
                document.getElementById("modal-body").innerHTML = response.message;    
                $("#responseModal").modal("show");
                AddressResponse = {"original_address": response.original_address, "formated_address": response.formated_address};
            }
            else if(this.readyState == 4 && this.status != 200)
            {
                console.log(this);
            }
            document.getElementById("submitbutton").disabled = false; 
        };
        xhttp.open("POST", "xhrRequest", false);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send(params);
    }, 500);
}
function saveAddress(event){
    event.preventDefault();
    document.getElementById("submitbutton").disabled = true; 
    document.getElementById("modal-message").innerHTML = "Please wait...";
    setTimeout(function ()
    {
        let tab = document.querySelector('.nav-link.active').id
        let address_type = (tab == "usps-address" ? "formatted" : "original");
        let address = (tab == "usps-address" ? AddressResponse.formated_address : AddressResponse.original_address); 
        let params = JSON.stringify({'action':'save_address', 'address':address, 'address_type':address_type});
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                let response = JSON.parse(this.responseText);
                document.getElementById("message").innerHTML = "";
                document.getElementById("modal-message").innerHTML = response.message;
                $("#responseModal").modal("show");
                setTimeout(function () { location.reload(); }, 5000);
            }
            else if(this.readyState == 4 && this.status != 200)
            {
                let response = JSON.parse(this.responseText);
                document.getElementById("modal-message").innerHTML = response.message;
            }
            document.getElementById("save-address").disabled = false; 
        };
        xhttp.open("POST", "xhrRequest", false);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send(params);
    }, 500);
}
