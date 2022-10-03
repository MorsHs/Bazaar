 <?php
    // Initialize the session
    session_start();

    // Check if the user is logged in, otherwise redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $new_password = $confirm_password = "";
    $new_password_err = $confirm_password_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate new password
        if (empty(trim($_POST["new_password"]))) {
            $new_password_err = "Please enter the new password.";
        } elseif (strlen(trim($_POST["new_password"])) < 6) {
            $new_password_err = "Password must have atleast 6 characters.";
        } else {
            $new_password = trim($_POST["new_password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm the password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($new_password_err) && ($new_password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        // Check input errors before updating the database
        if (empty($new_password_err) && empty($confirm_password_err)) {
            // Prepare an update statement
            $sql = "UPDATE users SET password = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                // Set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Password updated successfully. Destroy the session, and redirect to login page
                    session_destroy();
                    header("location: login.php");
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($link);
    }
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <title>Cst4L - reset password or cancel</title>
     <link rel="stylesheet" href="css/bootstrap-5/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/reset.css">
     <style>
         body {
             font: 14px sans-serif;
             background-color: gainsboro;
         }

         .wrapper {
             width: 350px;
             /* top right btm left */
         }
     </style>
 </head>

 <body>
     <div class="wrapper">
         <div class="reset-out">
             <!-- <h2>Reset Password</h2>
             <p>Please fill out this form to reset your password.</p> -->
             <div class="reset-password-text" id="reset-password-main">
                Reset password
             </div>
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="main-form">
                 <div class="form-group">
                     <label>New Password</label>
                     <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                     <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                 </div>
                 <div class="form-group">
                     <label>Confirm Password</label>
                     <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                     <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                 </div>
                 <div class="form-group">
                     <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                     <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
                 </div>
             </form>
         </div>
     </div>
     <script src="js/welcome.js"></script>
 </body>

 </html>
