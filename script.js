$(document).ready(function() {
  
  
    $('#set').click(function(e){
      e.preventDefault();
      var set_clip = $("#set_clip").val();
      $.ajax({
          type: "POST",
          url: "saveclip.php",
          dataType: "json",
          data: {data:set_clip},
          success : function(data){
              if (data.valid == 1){
                  $("#set_msg").text("Clip Saved successfully. Id to retrive clip is " + data.public_id);
                } 
              
              else {
                $("#set_msg").text("error: " + data.error);
              }
          }
      });
    });

    $('#get').click(function(e){
      e.preventDefault();
      var get_id = $("#get_id").val();
      $.ajax({
          type: "POST",
          url: "getclip.php",
          dataType: "json",
          data: {id:get_id},
          success : function(data){
              if (data.valid == 1){
                  $("#get_clip").html(data.clip);
                } 
              
              else {
                $("#get_clip").html("error: " +data.error);
              }
          }
      });
    });


});