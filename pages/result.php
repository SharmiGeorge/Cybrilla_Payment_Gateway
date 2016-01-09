<!DOCTYPE html> 
<html lang="en" ng-app="app">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assignment Cybrilla</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="../bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <script src="../bower_components/angular/angular.js"></script>
    <script src="../bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script src="../main.js"></script>

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php
            include 'nav.php';
        ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Make Payment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" id = "paymentForm">
                        <form action="#">
                            <div class="panel-heading">
                                Payment Details
                            </div>
                            <div class="panel-body">
                                <div class="row ">
                                    <div class="col-lg-6" >
                                    <?php 
                                        $ifscCode= $_POST["ifscCode"];
                                        $bankAccountNumber = $_POST["bankAccountNumber"];
                                        $amount = $_POST["amount"];
                                        $merchantTransactionReference= $_POST["merchantTransactionReference"];
                                        $transactionDate = $_POST["transactionDate"];
                                        $paymentGatewayMerchantReference = $_POST["paymentGatewayMerchantReference"];

                                        $paymentdata = "bank_ifsc_code="+$ifscCode+
                                                        "|bank_account_number="+$bankAccountNumber+
                                                        "|amount="+$amount+
                                                        "|merchant_transaction_ref="+$merchantTransactionRef+
                                                        "|transaction_date="+$transactionDate+
                                                        "|payment_gateway_merchant_refrence="+$paymentGatewayMerchantReference;
                                        
                                        $payload_with_sha = sha1($paymentdata);
                                        $payload_to_base64_encode = base64_encode($payload_with_sha);
                                        $method = "aes-128-cbc";
                                        $passkey = "Q9fbkBF8au24C9wshGRW9ut8ecYpyXye5vhFLtHFdGjRg3a4HxPYRfQaKutZx5N4";
                                        $payload_to_pg = sslEnc($payload_to_base64_encode);

                                        $response = http_post_fields("http://examplepg.com/transaction", $payload_to_pg);

                                        $results= array();
                                        if($response){
                                            $base64EncodeData = sslDec($response); 
                                            $decodedData = base64_decode($base64EncodeData);

                                            $i = 0;
                                            foreach ($decodedData as $value) {
                                                if($value == "=")
                                                {   
                                                    $result = [];
                                                    for ($j=$i; $j < 100; $j++) { 
                                                        if($decodedData[$i] == "|")
                                                        {
                                                            break;
                                                        }
                                                        $result[] = $decodedData[$i];
                                                    }
                                                    $results[] = $result;
                                                }
                                                $i++;
                                            }

                                            $status= $results[0];
                                            $amount = $results[1];
                                            $merchantTransactionReference= $results[2];
                                            $transactionDate= $results[3];
                                            $paymentGatewayMerchantReference = $results[4];
                                            $paymentGatewayTransactionReference = $results[5];

                                            echo"<div  class='col-lg-12'>";
                                                    
                                                    echo"<div class='col-lg-12 form-group'>";
                                                        echo"<label>Transaction Status</label>";
                                                        echo"<label class='input-medium right'>"+ $results[0] +"</label>";
                                                    echo"</div>";

                                                    echo"<div class='col-lg-12 form-group'>";
                                                        echo"<label >Amount</label>";
                                                        echo"<label class='input-medium right'>"+ $results[1] +"</label>";
                                                    echo"</div>";

                                                    echo"<div class='col-lg-12 form-group'>";
                                                        echo"<label for='merchant_transaction_reference'>Merchant Transaction Reference</label>";
                                                        echo"<label class='input-medium right'>"+ $results[2] +"</label>";
                                                    echo"</div>";

                                                    echo"<div class='col-lg-12 form-group'>";
                                                        echo"<label for='transaction_date'>Transaction Date</label>";
                                                        echo"<label class='input-medium right'>"+ $results[3] +"</label>";
                                                    echo"</div>";

                                                    echo"<div class='col-lg-12 form-group'>";
                                                        echo"<label for='payment_gateway_merchant_reference'>Payment Gateway Merchant Reference</label>";
                                                        echo"<label class='input-medium right'>"+ $results[4] +"</label>";
                                                    echo"</div>";

                                                    echo"<div class='col-lg-12 form-group'>";
                                                        echo"<label for='payment_gateway_transaction_reference'>Payment Gateway Transaction Reference</label>";
                                                        echo"<label class='input-medium right'>"+ $results[5] +"</label>";
                                                    echo"</div>";

                                                echo"</div>";
                                        }

                                        function sslPrm()
                                        {
                                            return array("Q9fbkBF8au24C9wshGRW9ut8ecYpyXye5vhFLtHFdGjRg3a4HxPYRfQaKutZx5N4","aes-128-cbc");
                                        }

                                        function sslEnc($msg)
                                        {
                                          list ($pass, $method)=sslPrm();
                                          if(function_exists('openssl_encrypt'))
                                             return urlencode(openssl_encrypt(urlencode($msg), $method, $pass, false));
                                          else
                                             return urlencode(exec("echo \"".urlencode($msg)."\" | openssl enc -".urlencode($method)." -base64 -nosalt -K ".bin2hex($pass)));
                                        }

                                        function sslDec($msg)
                                        {
                                          list ($pass, $method)=sslPrm();
                                          if(function_exists('openssl_decrypt'))
                                             return trim(urldecode(openssl_decrypt(urldecode($msg), $method, $pass, false)));
                                          else
                                             return trim(urldecode(exec("echo \"".urldecode($msg)."\" | openssl enc -".$method." -d -base64 -nosalt -K ".bin2hex($pass))));
                                        }
                                    ?>

                                    </div>
                                </div>
                                            <br><center>
                                            <input type="button" class="btn btn-default" text="Make Another Payment"></center>
                            </div>
                            <!-- /.panel-body -->
                        </form>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
