$(function(){
    $(document).on('click', '.add-to-cart', function(e){
        let quantity = 1;
        let id = $(this).data('id');
        let url = $(this).data('url');
        $.ajax({
            type: "POST",
            url,
            data: {id, quantity},
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });    
    
    $(document).on('click', '.increase', function(e){
        let url = $(this).data('url');
        $.ajax({
            type: "GET",
            url,
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });    
    
    $(document).on('click', '.decrease', function(e){
        let url = $(this).data('url');
        $.ajax({
            type: "GET",
            url,
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });    
    
    $(document).on('click', '.remove', function(e){
        let url = $(this).data('url');
        $.ajax({
            type: "GET",
            url,
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });


    
});