<?php

$errors = array();

$userDetails = array();

if (isset($_POST['submit'])) {
    if (empty($_POST['fname'])) {
        $errors['fullNameErr'] = "Enter your full name";
    }
    else if (!preg_match("/^[a-zA-Z-' ]*$/", trim($_POST['fname']))) {
        $errors['fullNameErr'] = "Full name is not valid.";
    }
    else if (count(explode(" ", $_POST['fname'])) < 2) {
        $errors['fullNameErr'] = "Full name must include First and Last name";
    }
    else {
        $userDetails['name'] = $_POST['fname'];
    }

    if (empty($_POST['email'])) {
        $errors['emailErr'] = "Enter your email address";
    }
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['emailErr'] = "Enter a valid email address";
    }
    else {
        $userDetails['email'] = $_POST['email'];
    }

    if (empty($_POST['pnum'])) {
        $errors['phoneErr'] = "Enter your phone number";
    }
    else if (!is_numeric(trim($_POST['pnum'])) or strlen(trim($_POST['pnum'])) != 11) {
        $errors['phoneErr'] = "Enter a valid phone number";
    }
    else {
        $userDetails['number'] = $_POST['pnum'];
    }

    if (empty($_POST['nin'])) {
        $errors['ninErr'] = "Enter your NIN";
    }
    else if (!is_numeric(trim($_POST['nin'])) or strlen(trim($_POST['nin'])) != 11) {
        $errors['ninErr'] = "Enter a valid NIN of 11 digits";
    }
    else {
        $userDetails['nin'] = $_POST['nin'];
    }

    $userDetails['state'] = $_POST['state'];
    $userDetails['lga'] = $_POST['lga'];





}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container mt-5">
        <form action="generator.php" method="post" <?php if (isset($_POST['submit']) && $errors === array()) {
    echo 'style="display: none"';
}
if (isset($_POST['generate']) && $errors === array()) {
    echo 'style="display: block"';
}?>>
            <div class="row">
                <div class="form-floating my-3 col-md-4">
                    <label for="fname" class="ps-4 form-label">Full name</label>
                    <input type="text" class="form-control" id="fname" placeholder="John Doe" name="fname"
                        value="<?php if(isset($_POST['submit'])){ echo $_POST['fname'];} ?>">
                    <small class="text-danger"><?php
if (array_key_exists('fullNameErr', $errors)) {
    echo $errors['fullNameErr'];
}
?>
                    </small>
                </div>
                <div class="form-floating my-3 col-md-4">
                    <label for="email" class="ps-4 form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email"
                        value="<?php if(isset($_POST['submit'])){ echo $_POST['email'];} ?>">
                    <small class="text-danger"><?php
if (array_key_exists('emailErr', $errors)) {
    echo $errors['emailErr'];
}
?>
                    </small>
                </div>
                <div class="form-floating my-3 col-md-4">
                    <label for="pnum" class="ps-4 form-label">Phone number</label>
                    <input type="text" class="form-control" id="pnum" placeholder="1234567890" name="pnum"
                        value="<?php if(isset($_POST['submit'])){ echo $_POST['pnum'];} ?>">
                    <small class="text-danger"><?php
if (array_key_exists('phoneErr', $errors)) {
    echo $errors['phoneErr'];
}
?>
                    </small>
                </div>
                <div class="form-floating my-3 col-md-4">
                    <label for="nin" class="ps-4 form-label">NIN</label>
                    <input type="text" class="form-control" id="nin" placeholder="Enter your NIN" name="nin"
                        value="<?php if(isset($_POST['submit'])){ echo $_POST['nin'];} ?>">
                    <small class="text-danger"><?php
if (array_key_exists('ninErr', $errors)) {
    echo $errors['ninErr'];
}
?>
                    </small>
                </div>

                <div class="form-floating my-3 col-md-4">
                    <label for="state" class="ps-4 form-label">State of Origin</label>
                    <select class="form-select" name="state">
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                    </select>
                </div>

                <div class="form-floating my-3 col-md-4">
                    <label for="lga" class="ps-4 form-label">LGA</label>
                    <select class="form-select" name="lga">
                        <option value="Umuahia">Umuahia</option>
                        <option value="Yola">Yola</option>
                        <option value="Uyo">Uyo</option>
                        <option value="Awka">Awka</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Yenegoa">Yenegoa</option>
                    </select>
                </div>
            </div>
            <input type="submit" name="submit" value="Generate my ID" class="btn btn-success mb-2">
        </form>

        <div id="displayCard" class="container mt-5" <?php if (isset($_POST['submit']) && $errors === array()) {
    echo 'style="display: block"';
}
if (isset($_POST['generate']) && $errors === array()) {
    echo 'style="display: none"';
}?>>
            <div class="row justify-content-center">
                <div id="idCard" class="col-8 col-md-4">
                    <div id="content" class="text-center">
                        <h3 class="mt-3 text-center">ID CARD GENERATOR</h3>
                        <div>
                            <img class="img-fluid" src="ei_1655290395456-removebg-preview.png" alt="">
                        </div>
                        <h4 class="mt-2"><?php if (array_key_exists('name', $userDetails)) {
    echo $userDetails['name'];
}
?></h4>
                        <p>PRODUCTION MANAGER</p>
                        <p>NIN: <span><?php if (array_key_exists('nin', $userDetails)) {
    echo $userDetails['nin'];
}

?> </span></p>
                        <p>Phone number: <span><?php if (array_key_exists('number', $userDetails)) {
    echo $userDetails['number'];
}

?> </span></p>
                        <p>Email: <span><?php if (array_key_exists('email', $userDetails)) {
    echo $userDetails['email'];
}

?> </span></p>
                        <div class="row">
                            <div class="col-6">
                                <p>State: <span><?php
echo $userDetails['state'];
?> </span></p>
                            </div>
                            <div class="col-6">
                                <p>LGA: <span><?php
echo $userDetails['lga'];
?> </span></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>