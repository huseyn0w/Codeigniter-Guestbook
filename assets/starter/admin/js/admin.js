$(function(){
   $(".delete-review").on('click', function () {

       var message = confirm('are you sure?');
       if(message){
           var id = +$(this).data('deleteid');

           var clicked_button = $(this);


           if(id > 0)
           {
               var url = siteURL + 'ajax_action/' + id;
               var action = 'delete';
               ajax_action(url, action, id, clicked_button);

           }
       }



   });

    $(".approve-review").on('click', function () {

        var id = +$(this).data('approveid');

        var clicked_button = $(this);


        if(id > 0)
        {
            var url = siteURL + 'ajax_action/' + id;
            var action = 'approve';
            ajax_action(url, action, id, clicked_button);

        }

    });


   function ajax_action(url, action, id, clicked_button){
       $.ajax({
           method: "POST",
           url: url,
           data: {
               postType:'review',
               action:action,
               id: id,
               'ci_guestbook_csrf':tokenHash
           },
           success: function (serverResult){

               console.log(serverResult);

               var result = jQuery.parseJSON( serverResult );
               var code = result.code;
               var message = result.message;


               if(code === "OK"){
                   $(".action-ok").text(message).fadeIn(1000).delay(3000).fadeOut(1000);
                   clicked_button.parent().parent().fadeOut();

                   clicked_button.parent().parent().remove();

                   var table_lenght = $(".reviews-table tbody tr").length;
                   if(table_lenght === 0){
                       $(".new-reviews").hide();
                   }

                   var message_count = +$(".message_count").text();
                   if(message_count > 0){
                       message_count--;
                       $(".message_count").text(message_count);
                   }

               }
               else{
                   $(".action-error").text(message).fadeIn(1000).delay(3000).fadeOut(1000);
               }
           }
       });
   }
});