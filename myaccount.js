$.ajax({
    type: "GET",
    url: 'UserInfo.php',
    dataType: "json",
    success: function(data){
        console.log(data);
        //$('.drinks').append("<hr>");
        //$('.drinks').append("<tr>");
        if(data[0].drinks == 1){
          max = data[0].drinks;
        }
        else{
          max = data[0].drinks - 1;
        }
        for(var i = 0; i < max; i++){
          var contents = $('.delete')[0]
          contents.style.display = "block";
          var contents = $('.drinks')[0]
          contents.style.display = "block";
          $('.drinks').append("<hr>");
          $('.drinksDelete').append("<option value =" + data[11][i] + ">" + data[0][i] + "</option>");
          $('.drinks').append("<p>" + "<strong>Drink Title:</strong> " + data[0][i] + "</p>\n");
          $('.drinks').append("<p>" + "<strong>Drink Description:</strong> " + data[1][i] + "</p>\n");
        }
        $('.drinks').append("<hr>");


        if(data[2].comments == 1){
          max = data[2].comments;
        }
        else{
          max = data[2].comments - 1;
        }
        //console.log(data[2].comments);
        for(var i = 0; i < max; i++){
          var contents = $('.Comments')[0]
          contents.style.display = "block";
          $('.Comments').append("<hr>");
          $('.Comments').append("<p>" + "<strong>Comment:</strong> " + data[2][i] + "</p>\n");
          $('.Comments').append("<p>" + "<strong>Drink Title:</strong> " + data[3][i] + "</p>\n");
          $('.Comments').append("<p>" + "<strong>Made By:</strong> " + data[4][i] + "</p>\n");
        }
        $('.Comments').append("<hr>");

        if(data[5].username == 1){
          max = data[5].username;
        }
        else{
          max = data[5].username - 1;
        }
        for(var i = 0; i < max; i++){
          var contents = $('.Likes')[0]
          contents.style.display = "block";
          if(i == 0){
            $('.Likes').append("<hr>");
          }
          $('.Likes').append("<p>" + "You liked the drink " + data[6][i] + " created by " + data[5][i] + "</p>\n");
        }
        $('.Likes').append("<hr>");

        if(data[10].email == 1){
          max = data[10].email;
        }
        else{
          max = data[10].email - 1;
        }
        for(var i = 0; i < 1; i++){
          $('.info').append("<hr>");
          $('.info').append("<p>" + "<strong>Name:</strong> " + data[8][i] + " " + data[9][i] + "</p>\n");
          $('.info').append("<p>" + "<strong>Birthday:</strong> " + data[7][i] + "</p>\n");
          $('.info').append("<p>" + "<strong>Email:</strong> " + data[10][i] + "</p>\n");
        }
        $('.info').append("<hr>");

    }
});
