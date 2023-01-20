<?php 
    require_once("config.php"); 
    $states  = json_decode(STATES, TRUE);
?>
<html>
    <head>
        <title>Address Validator</title>
        <link rel="icon" type="image/x-icon" href="https://www.usps.com/assets/images/home/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="assets/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row bg-grey">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-haeder p-3">
                            <h3 class="p-0">Address Validator</h3>
                            <p class="mb-2 text-muted">Address Validation/Standardization</p>
                            <hr class="m-0">
                        </div>
                        <div class="card-body">
                            <form class="row g-3" id="address-form">
                                <div class="col-12">
                                    <label for="addressline1" class="form-label">Address Line 1</label>
                                    <input type="text" name="addressline1" id="addressline1" class="form-control" placeholder="1234 Main St" value="4 South Central Ave">
                                </div>
                                <div class="col-12">
                                    <label for="addressline2" class="form-label">Address Line 2</label>
                                    <input type="text" name="addressline2" id="addressline2" class="form-control" placeholder="Apartment, studio, or floor" value="Suite 1">
                                </div>
                                <div class="col-12">
                                    <label for="addresscity" class="form-label">City</label>
                                    <input type="text" name="addresscity" id="addresscity" class="form-control" value="St Louis">
                                </div>
                                <div class="col-12">
                                    <label for="addressstate" class="form-label">State</label>
                                    <select name="addressstate" id="addressstate" class="form-select">
                                        <option disabled>Select State</option>
                                        <?php foreach($states as $code => $state): ?>
                                            <option value="<?=@$code?>" <?=@($code == "MO" ? "selected" : "")?>><?=@$state?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="addresszipcode" class="form-label">Zip Code</label>
                                    <input type="text" name="addresszipcode" id="addresszipcode" class="form-control" value="63105">
                                </div>
                                <div class="col-12">
                                    <p id='message' class="mb-4 alert alert-info"></p>
                                    <button type="button" id="submitbutton" onclick="validateAddress(event)" class="btn btn-primary text-uppercase font-weight-bold">Validate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="responseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="responseModalLabel">Save Address</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body"></div>
                    <div class="modal-footer">
                        <p id='modal-message' class="col-12 mb-4 alert alert-info"></p>
                        <button type="button" id='save-address' onclick="saveAddress(event)" class="btn btn-primary px-4 btn-sm btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.slim.js" integrity="sha512-M3zrhxXOYQaeBJYLBv7DsKg2BWwSubf6htVyjSkjc9kPqx7Se98+q1oYyBJn2JZXzMaZvUkB8QzKAmeVfzj9ug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="assets/main.js"></script>
    </body>
</html>