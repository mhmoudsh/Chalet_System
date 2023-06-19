$(document).ready(function(){





    $(document).on('change','#select-status',function(e){
        make_search();
    });



    $(document).on('input','#search_by_text',function(e){
        make_search();
    });







    function make_search(){
        var search_by_status=$("#select-status").val();
        var search_by_text=$("#search_by_text").val();
        var token_search=$("#token_search").val();
        var ajax_search_url=$("#ajax_search_url").val();
        // $('#loading').css('display', 'flex');

        jQuery.ajax({
            url:'subscriptions_search',
            type:'post',
            dataType:'html',
            cache:false,
            data:{
                search_by_status:search_by_status,
                search_by_text:search_by_text,
                "_token":token_search,
            },
            success:function(data){

                console.log(data)
                $("#search_ajax").html(data);
            },
            error:function(){
                console.log(data)
            }
        });

    }

    $(document).on('click','#ajax_pagination_in_search a ',function(e){
        e.preventDefault();
        var search_by_text=$("#select-status").val();
        var token_search=$("#token_search").val();
        var url=$(this).attr("href");

        jQuery.ajax({
            url:url,
            type:'post',
            dataType:'html',
            cache:false,
            data:{
                search_by_text:search_by_text,
                "_token":token_search
            },
            success:function(data){

                $("#search_ajax").html(data);
            },
            error:function(){

            }
        });



    });







});
