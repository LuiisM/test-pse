'use strict';

/**
 * @ngdoc service
 * @name test APP
 * @description
 * # testApp
 * Factory in the testApp.
 */
angular.module('testApp')
    .factory('PlacetopayService', function($resource) {
        // Service logic
        // Public API here
        return $resource('http://localhost/test/public/api/v1/ptp/test', {
            id: '@id'
        }, {
            getBankList: {
                url: 'http://localhost/test/public/api/v1/ptp/test/bank',
                method: 'GET',
                isArray: true
            },
            createTransaction: {
                url: 'http://localhost/test/public/api/v1/ptp/test/transaction',
                method: 'POST'
            },
            getTransaction: {
                url: 'http://localhost/test/public/api/v1/ptp/test/transaction/:id',
                method: 'GET',
                isArray: false
            },
            createTransactionMulti: {
                url: 'http://localhost/test/public/api/v1/ptp/test/transactionmulticredit',
                method: 'POST'
            }

        });
    });
