<?php
session_start();
error_reporting(1);

$db_config_path = '../application/config/database.php';

if (!isset($_SESSION["license_code"])) {
    $_SESSION["error"] = "Invalid purchase code!";
    header("Location: index.php");
    exit();
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {
        
        mysqli_query($connection, "UPDATE settings SET version = 'v1.8' WHERE id = 1;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `country` INT NULL DEFAULT '178' AFTER `currency`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `time_zone` INT NULL DEFAULT '51' AFTER `lang`;");
        mysqli_query($connection, "ALTER TABLE `payment_records` ADD `type` VARCHAR(255) NULL DEFAULT 'income' AFTER `note`;");
        mysqli_query($connection, "ALTER TABLE `settings` ADD `enable_frontend` INT NULL DEFAULT '1' AFTER `enable_faq`;");
        mysqli_query($connection, "UPDATE `package_features` SET `text` = 'Set -1 for Yes & 0 for No' WHERE `package_features`.`id` = 6;");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Bills', 'bills', 'Bills'), (NULL, 'user', 'Create New Bill', 'create-new-bill', 'Create New Bill');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Edit Bill', 'edit-bill', 'Edit Bill'), (NULL, 'user', 'Save Bill', 'save-bill', 'Save Bill');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Bill', 'bill', 'Bill');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Record a payment for this bill', 'record-payment-bill', 'Record a payment for this bill');");
        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Sales', 'sales', 'Sales'), (NULL, 'user', 'Purchases', 'purchases', 'Purchases');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Partial', 'partial', 'Partial');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Income by Customer', 'income-by-customer', 'Income by Customer'), (NULL, 'user', 'Purchases by Vendor', 'purchases-by-Vendor', 'Purchases by Vendor');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Purchase', 'purchase', 'Purchase');");
        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Profit & Loss', 'profit-loss', 'Profit & Loss'), (NULL, 'user', 'Paid & Unpaid', 'paid-unpaid', 'Paid & Unpaid');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Including paid & unpaid invoices and bills', 'paid-unpaid-inv-bill', 'Including paid & unpaid invoices and bills'), (NULL, 'user', 'Including only paid invoices and bills', 'paid-inv-bill', 'Including only paid invoices and bills');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Net Profit', 'net-profit', 'Net Profit');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Sales Tax Report', 'sales-tax-report', 'Sales Tax Report'), (NULL, 'user', 'Sales Product to tax', 'sales-product-tax', 'Sales Product to tax'), (NULL, 'user', 'Tax Amount on Sales', 'tax-amount-sale', 'Tax Amount on Sales'), (NULL, 'user', 'Purchases Subject to Tax', 'purchase-subject', 'Purchases Subject to Tax'), (NULL, 'user', 'Tax Amount on Purchases', 'tax-amount-purchase', 'Tax Amount on Purchases'), (NULL, 'user', 'Net Tax Owing', 'tax-owing', 'Net Tax Owing');");


        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'Signing in ...', 'signing-in', 'Signing in ...');");


        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Select Vendor', 'select-Vendor', 'Select Vendor');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'General', 'general', 'General');");
        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Purchase from', 'purchase-from', 'Purchase from');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Bill Number', 'bill-number', 'Bill Number');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'Frontend Website', 'enable-frontend', 'Frontend Website');");
        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Search by name or email', 'search-by-name-email', 'Search by name or email');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'All Packages', 'all-package', 'All Packages');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Website Settings', 'website-settings', 'Website Settings');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Your customer has paid some partial payment for this invoice.', 'partial-payment', 'Your customer has paid some partial payment for this invoice.');");


        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Set -2 for Unlimited, -1 for Yes & 0 for No', 'limit-suggestions', 'Set -2 for Unlimited, -1 for Yes & 0 for No');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Enable access to show your frontend website.', 'enable-frontend-info', 'Enable access to show your frontend website.'), (NULL, 'admin', 'Enable access to active multilingual system.', 'enable-multilingual-info', 'Enable access to active multilingual system.'), (NULL, 'admin', 'Enable to active reCaptcha for all public forms (Sign up, contacts).', 'enable-captcha-info', 'Enable to active reCaptcha for all public forms (Sign up, contacts).'), (NULL, 'admin', 'Enable to allow sign up users to your site.', 'registration-system-info', 'Enable to allow sign up users to your site.'), (NULL, 'admin', 'Enable to allow email verification for registered users.', 'email-verification-info', 'Enable to allow email verification for registered users.'), (NULL, 'admin', 'Enable Payment = Your users need to complete their payment for access all features <br> Disable Payment = Your users will access all features without completing payments.', 'enable-payment-info', 'Enable Payment = Your users need to complete their payment for access all features <br> Disable Payment = Your users will access all features without completing payments.'), (NULL, 'admin', 'Enable to allow delete invoice in user business.', 'delete-invoice-info', 'Enable to allow delete invoice in user business.'), (NULL, 'admin', 'Enable to active discount system', 'discount-info', 'Enable to active discount system'), (NULL, 'admin', 'Enable to show blogs option in frontend', 'blogs-info', 'Enable to show blogs option in frontend'), (NULL, 'admin', 'Enable to show FAQs option in frontend', 'faqs-info', 'Enable to show FAQs option in frontend');");



        $query = '';
        $sqlScript = file('sql/time_zone.sql');
        foreach ($sqlScript as $line) {
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


      /* close connection */
      mysqli_close($connection);

      $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://" . $_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $redir = str_replace('updates/update_v1.7_v1.8/', '', $redir);
      header("refresh:5;url=" . $redir);
      $success = 1;
    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accufy &bull; Update Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2">

                <div class="row">
                    <div class="col-sm-12 logo-cnt">
                        <p>
                           <img src="assets/img/logo.png" alt="">
                       </p>
                       <h1>Welcome to the update installer</h1>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                            <div class="alert alert-danger">
                                <strong><?php echo htmlspecialchars($message); ?></strong>
                            </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                            <div class="alert alert-success">
                                <strong>Completing Updates ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 second </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

