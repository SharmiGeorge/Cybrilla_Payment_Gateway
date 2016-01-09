angular.module('app', ['ui.bootstrap']).controller('PaymentGateway', function ($scope, $uibModal, $http) {

  $scope.makePayment = function() {

    paymentdata = ("bank_ifsc_code="+$scope.ifscCode+"|bank_account_number="+$scope.bankAccountNumber+
                  "|amount="+$scope.amount+"|merchant_transaction_ref="+$scope.merchantTransactionRef+
                  "|transaction_date="+$scope.transactionDate+"|payment_gateway_merchant_refrence="+$scope.paymentGatewayMerchantReference);

    // console.log("SUCCESS",$scope.addAd);
    var req = {
      method: 'POST',
      url: 'http://examplepg.com/transaction',
      headers: {
        'Content-Type': 'application/json'
      },
      data: { 
         
      }
    }

    $http(req).then(function(){
      $scope.ServerResponse = data;
    console.log("SUCCESS", req.data);
    }, 

    function(){
      console.log("FAILED", req.data);
    });
  };

});


