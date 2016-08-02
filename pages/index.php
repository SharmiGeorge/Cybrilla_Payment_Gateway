<!DOCTYPE html> 
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Anusha</title>

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
                <div class="col-lg-12" >
                    <div class="panel panel-default" id = "paymentForm">
                        <form action="result.php">
                            <div class="panel-heading">
                                Enter the Payment Details
                            </div>
                            <div class="panel-body">
                                <div class="row ">
                                    <div class="col-lg-6"> 
                                            <div class="alert alert-danger" id = "formError" role="alert" style="display:none">
                                            </div>
                                            <div  class="col-lg-12">
                                                
                                                <div class="col-lg-12 form-group">
                                                    <label for="bank_ifsc_code">Bank IFSC Code</label>
                                                    <input type="text" name="ifscCode" class="input-medium right" required>
                                                </div>

                                                <div class="col-lg-12 form-group">
                                                    <label for="bank_account_number">Bank Account Number</label>
                                                    <input type="text" name="bankAccountNumber" class="input-medium right" required>
                                                </div>

                                                <div class="col-lg-12 form-group">
                                                    <label for="Amount">Amount</label>
                                                    <input type="text" name="amount" class="input-medium right" required>
                                                </div>

                                                <div class="col-lg-12 form-group">
                                                    <label for="merchant_transaction_reference">Merchant Transaction Reference</label>
                                                    <input type="text" name="merchantTransactionRef" class="input-medium right" required>
                                                </div>

                                                <div class="col-lg-12 form-group">
                                                    <label for="transaction_date">Transaction Date</label>
                                                    <input type="date" name="transactionDate" class="input-medium right" required>
                                                </div>

                                                <div class="col-lg-12 form-group">
                                                    <label for="payment_gateway_merchant_reference">Payment Gateway Merchant Reference</label>
                                                    <input type="text" name="paymentGatewayMerchantReference" class="input-medium right" required>
                                                </div>
                                                
                                            </div>
                                    </div>
                                </div>
                                            <br><center>
                                            <input type="submit" class="btn btn-default"></center>
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
