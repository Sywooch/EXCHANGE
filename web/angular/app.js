var app = angular.module('ExchangeApp', []);

app.controller('FormController', ['$scope', '$http', function($scope, $http){
    $http.get('currency?_format=json').then(function(response){
        $scope.currencies = response.data.filter(function(item){
            return item.directionsCount;
        });
        $scope.activeCurrency = $scope.currencies[0];
    });

    $http.get('direction?_format=json').then(function(response){
        $scope.directions = response.data;
    });

    $scope.directionActive = 0;

    $scope.changeCurrency = function(obj){
        $scope.activeCurrency = obj;
        $scope.exchange_to = 0;
        $('#cur_from').val(obj.id).data('dd').refresh();
    };

    $scope.changeDirection = function(obj){
        $scope.directionActive = obj;
        $scope.exchange_from = 0;
        $('#cur_to').val(obj.to.id).data('dd').refresh();
    }

    $scope.countExchangeResult = function(){
        return $scope.exchange_from ? (parseFloat($scope.exchange_from) * parseFloat($scope.directionActive.courseCounted)).toFixed(2) : 0
    }
}]);