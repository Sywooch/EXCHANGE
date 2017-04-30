$(document).ready(function(){
    var menuShowFlag = false;
    $('header button.main-nav-button').on('click', function(){
        if (!menuShowFlag) {
            $('header nav').css({'top':'0%'});
            menuShowFlag = true;
        }else if(menuShowFlag){
            $('header nav').css({'top':'-100%'});
            menuShowFlag = false;
        }
    });    
    
    //div.lk-main > div.stat > div.ah-table > div.tabs
    $('div.lk-main .stat .ah-table .tabs .tab').on('click', function(){
        var tab = $(this).attr('data-target-id');
        //alert(tab);
        $('div.lk-main .stat .ah-table .tabs .tab').removeClass('active');
        $(this).addClass('active');
        $('div.lk-main .stat .ah-table .tabs-data .tab-content').removeClass('active');
        $('#'+tab).addClass('active');
    });
});