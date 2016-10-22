'use strict';

/**
 * @ngdoc controller
 * @name test APP
 * @description
 * # testApp
 * Controller in the testApp.
 */
angular.module('testApp').controller('TranCtrl', function(PlacetopayService, $cookies, $window) {
    var vm = this;
    console.log($cookies.get('transactionID'));
    vm.init = function() {
        var transId = $cookies.get('transactionID');
        if(vm.search){
            transId = vm.search;
        }
        var promise = PlacetopayService.getTransaction({id:transId});
        promise.$promise.then(function(data) {
            vm.result = data;
        });
    };
    vm.init();
});
