 $(".check-driver").on("click",function()
      {
          if($(this).is(':checked')){
          alert($(this).attr("name"));
      }else{ 
          alert($(this).attr("name")+" uncheckc");}
      })  