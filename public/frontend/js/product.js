$(function(){
    $(document).on('click', 'a.btnShowDetails', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            type: "GET",
            url,
            beforeSend: function(){
                $(document).find('div.loading').show();
            },
            success: function(data)
            {
                $(document).find('div.loading').hide();
                $(document).find('div.lightboxContainer').html(data).show();
            }
        });
    });

      $(document).on('click', '.lightbox .close', function(){
        $('.lightboxContainer').hide();
      });

    //   $(document).on('click', 'div.lightboxContainer', function(){
    //     $(this).hide();
    //   });

      
});