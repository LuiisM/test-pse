'use strict';

/**
 * @ngdoc controller
 * @name test APP
 * @description
 * # testApp
 * Controller in the testApp.
 */
angular.module('testApp').controller('TestCtrl', function(PlacetopayService, $cookies,$window) {
    var vm = this;
    /*
     * Fields 
     */
    vm.test = {
        bankCode: "1022",
        bankInterface: "0",
        currency: "COP",
        description: "Test",
        devolutionBase: "0",
        language: "ES",
        payer: {
            document: "1047456097",
            city: "Cartagena",
            company: "Ninguna",
            country: "CO",
            documentType: "CC",
            emailAddress: "luisblanco93@hotmail.com",
            firstName: "Luis",
            lastName: "Blanco",
            mobile: "3178089367",
            phone: "3178089367",
            province: "Bolivar"
        },
        reference: "1",
        returnURL: "http://localhost/test/public/index.html#infosection",
        taxAmount: "0",
        tipAmount: "0",
        totalAmount: "5000"
    };
    /*
     * Expire date for cookie / 
     */
    var expireDate = new Date();
    expireDate.setDate(expireDate.getDate() + 1);
    /**
     *  Get the bank list from pse test API and save data in cookie
     */
    function init() {
        if (!$cookies.getObject('banklist')) {
            var promise = PlacetopayService.getBankList();
            promise.$promise.then(function(data) {
                vm.banklist = data;
                $cookies.putObject('banklist', vm.banklist, {
                    'expires': expireDate
                });
            });
        } else {
            vm.banklist = $cookies.getObject('banklist');
        }
    };
    init();
    /*
    * Send form to API
    */
    vm.send = function() {
        PlacetopayService.createTransaction(vm.test,function(response){
            $cookies.put('transactionID',response.transactionID);
            $window.location.href = response.bankURL+'#infosection';
            console.log("Response: ",response);
        },function(fail){
            console.log("Failed: ",fail);
        })
    };
});
