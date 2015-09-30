$(document).ready(function(){
    
  $("#submit").click(function(){

    var username = $("#myusername").val();
    var password = $("#mypassword").val();
    
    if((username == "") || (password == "")) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Por favor introduzca un nombre de usuario y una clave</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "checklogin.php",
        data: "myusername="+username+"&mypassword="+password,
        success: function(html){    
          if(html=='true') {			  
			  if(username=="boss"){
				window.location="perfil-boss.php";
			  }
			  if(username=="user"){
				window.location="perfil-user.php";
			  }
			  if(username=="sap"){
				window.location="emision.php";
			  }
          }
          else {
            $("#message").html(html);
          }
        },
        beforeSend:function()
        {
          $("#message").html("<p class='text-center'><img src='images/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
  });
});