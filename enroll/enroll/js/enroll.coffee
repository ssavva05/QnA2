$(document).ready ->
  $("#submit").click ->
    myenrollkey = $("#myenrollkey").val()
    if (myenrollkey is "")
      $("#message").html "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter an enrollkey</div>"
    else
      $.ajax
        type: "POST"
        url: "checklogin.php"
        data: "myenrollkey=" + myenrollkey
        success: (html) ->
          if html is "true"
            window.location = "index.php"
          else
            $("#message").html html

        beforeSend: ->
          $("#message").html "<p class='text-center'><img src='images/ajax-loader.gif'></p>"

    false

