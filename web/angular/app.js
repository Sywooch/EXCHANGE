var app = angular.module('ExchangeApp', []);

app.controller('FormController', ['$scope', '$http', '$timeout', function($scope, $http, $timeout){
    
    $http.get('/currency?_format=json').then(function(response){
        $scope.currencies = response.data.filter(function(item){
            return item.directionsCount;
        });
        $scope.changeCurrency($scope.currencies[0]);
        //$scope.activeCurrency = $scope.currencies[0];
        
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

    /*$scope.$watch('activeCurrency', function(){
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

            $timeout(function(){
                $('#citySelect').data('dd').destroy();
                $('#citySelect').msDropDown();
            }, 1000)
        }

        $timeout(function(){
            $('.rows').scrollbar('resize');
        }, 600);

        $scope.exchange_from = 0;
        $scope.exchange_to = 0;
    });*/
    
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
            console.log($('#cur_from').data('dd'));
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
        $("div.ah-give div.ah-content ul").on("click", 'li', function () {
            var curPic = $(this).find('i').attr('style');
            $('div.ah-application > div.ah-content > form > div > span.ng-binding > i.ah-icon.ah-icon-05').attr({'style':curPic});
        })
        $('#cur_from').val(obj.id).data('dd').refresh();
    };

    $scope.changeDirection = function(obj){
        $scope.directionActive = obj;
        $scope.exchange_from = 0;
        $("div.ah-get div.ah-content ul").on("click", 'li', function () {
            var curPic = $(this).find('i').attr('style');
            $('div.ah-application > div.ah-content > form > div > span.ng-binding > i.ah-icon.ah-icon-09').attr({'style':curPic});
        })
        $('#cur_to').val(obj.to.id).data('dd').refresh();
    };

    $scope.countExchangeResult = function(){
        
        var course = $scope.directionActive.courseCounted;
        
        var result = $scope.exchange_from ? (parseFloat($scope.exchange_from) * parseFloat(course)).toFixed(2) : 0;
        if(parseFloat($scope.exchange_from) < parseFloat($scope.directionActive.min)){
            return 0;
        }
        console.log(result);
        /*var comission = parseFloat($scope.exchange_from) * $scope.directionActive.exchange_percent / 100;

        if(comission < $scope.directionActive.min_comission){
            result = result - $scope.directionActive.min_comission;
        } else {
            result = result - comission;
        }

        console.log(comission);*/

        return result > 0 ? result : 0;
    };
    $scope.countExchangeFrom = function(){
        
        var course = $scope.directionActive.courseCounted;
        
        var result = $scope.exchange_to ? (parseFloat($scope.exchange_to) / parseFloat(course)).toFixed(2) : 0;
        /*var resultComm = $scope.exchange_to ? (parseFloat($scope.exchange_to) / parseFloat($scope.directionActive.courseCounted)).toFixed(2) : 0;
        if(result < parseFloat($scope.directionActive.min)){
            return 0;
        }
        var comission = resultComm - result;

        if(comission < $scope.directionActive.min_comission){
            result = parseFloat(result) + parseFloat($scope.directionActive.min_comission);
        } else {
            result = parseFloat(result) + parseFloat(comission);
        }

        console.log(comission);*/

        return result > 0 ? result : 0;
    }
}]);