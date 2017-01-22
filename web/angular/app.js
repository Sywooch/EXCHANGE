var app = angular.module('ExchangeApp', []);

app.controller('FormController', ['$scope', '$http', '$timeout', function($scope, $http, $timeout){
    $http.get('/currency?_format=json').then(function(response){
        $scope.currencies = response.data.filter(function(item){
            return item.directionsCount;
        });
        $scope.activeCurrency = $scope.currencies[0];

        $('#cur_to').data('dd').destroy();
        $('#cur_to').msDropDown();
        $('#cur_from').data('dd').destroy();
        $('#cur_from').msDropDown();

        $timeout(function(){
            $('.rows').scrollbar();
        }, 500);
    });

    $http.get('/direction?_format=json').then(function(response){
        $scope.directions = response.data.filter(function(item){
            return item.enabled;
        });

        $('#cur_to').data('dd').destroy();
        $('#cur_to').msDropDown();
        $('#cur_from').data('dd').destroy();
        $('#cur_from').msDropDown();

    });

    $scope.directionActive = 0;

    $scope.$watch('activeCurrency', function(){
        $('#cur_to').data('dd').destroy();
        $('#cur_to').msDropDown();
        $scope.directionActive = 0;
        $timeout(function(){
            $('.rows').scrollbar('resize');
        }, 500);
    });

    $scope.$watch('directionActive', function(newval){
        if(newval){
            $('#cur_to').data('dd').destroy();
            $('#cur_to').msDropDown();
        }

        $timeout(function(){
            $('.rows').scrollbar('resize');
        }, 600);

        $scope.exchange_from = 0;
        $scope.exchange_to = 0;

        $('#citySelect').data('dd').destroy();
        $('#citySelect').msDropDown();
    });

    $timeout(function(){
        $('#cur_to').data('dd').on('change', function(arg){
            var index = $(arg.currentTarget).val();
            $scope.directionActive = $scope.directions.find(function(item){
                return item.currency_to == index && item.currency_from == $scope.activeCurrency.id;
            });
            $scope.$apply();

            $('#cur_from').data('dd').refresh();
        });

        $('#cur_from').data('dd').on('change', function(arg){
            var index = $(arg.currentTarget).val();

            console.log(index);
            $scope.activeCurrency = $scope.currencies.find(function(item){
                return item.id == index;
            });
            $scope.directionActive = {};

            $scope.$apply();

            $('#cur_to').data('dd').refresh();
        });
    }, 1000);

    $scope.changeCurrency = function(obj){
        $scope.activeCurrency = obj;
        $scope.exchange_to = 0;
        $('#cur_from').val(obj.id).data('dd').refresh();
    };

    $scope.changeDirection = function(obj){
        $scope.directionActive = obj;
        $scope.exchange_from = 0;
        $('#cur_to').val(obj.to.id).data('dd').refresh();
    };

    $scope.countExchangeResult = function(){
        var result = $scope.exchange_from ? (parseFloat($scope.exchange_from) * parseFloat($scope.directionActive.courseCounted)).toFixed(6) : 0;
        var res_wo_comission = $scope.exchange_from ? (parseFloat($scope.exchange_from) * parseFloat($scope.directionActive.course)).toFixed(6) : 0;

        var comission = result - res_wo_comission;
        if(comission > $scope.directionActive.min_comission) {
            return res_wo_comission + $scope.directionActive.min_comission;
        }
        return result;
    };
    $scope.countExchangeFrom = function(){
        return $scope.exchange_to ? (parseFloat($scope.exchange_to) / parseFloat($scope.directionActive.courseCounted)).toFixed(2) : 0
    }
}]);