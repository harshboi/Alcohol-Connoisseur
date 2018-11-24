//Main Ajax call that gets user information from the DB to be displayed on the my-account.php page
$.ajax({
    type: "GET",
    url: 'UserInfo.php',
    dataType: "json",
    success: function(data){

        //Gets the number of drinks that a user has created and set that has the looping max
        if(data[0].drinks == 1){
          max = data[0].drinks;
        }
        else{
          max = data[0].drinks - 1;
        }

        //Loop through drink information (title, description, drink_ID) and append them to appropriate DIVs to display information
        for(var i = 0; i < max; i++){

          //Hide div contents if drink information isn't present for a user
          var contents = $('.delete')[0]
          contents.style.display = "block";
          var contents = $('.drinks')[0]
          contents.style.display = "block";
          var contents = $('.UpdateDrink')[0]
          contents.style.display = "block";

          //Append drink information to DIVs to be displayed on account page
          $('.drinks').append("<hr>");
          $('.drinksDelete').append("<option value =" + data[11][i] + ">" + data[0][i] + "</option>");
          $('.drinksUpdate').append("<option value =" + data[11][i] + ">" + data[0][i] + "</option>");
          $('.drinks').append("<p>" + "<strong>Drink Title:</strong> " + data[0][i] + "</p>\n");
          $('.drinks').append("<p>" + "<strong>Drink Description:</strong> " + data[1][i] + "</p>\n");
        }
        $('.drinks').append("<hr>");



        //Get number of comments that the user has made
        if(data[2].comments == 1){
          max = data[2].comments;
        }
        else{
          max = data[2].comments - 1;
        }

        //Loop through all the comments and appen to DIV so it can be displayed on the account page
        for(var i = 0; i < max; i++){

          //Hide comments if user hasn't created any comments yet
          var contents = $('.Comments')[0]
          contents.style.display = "block";

          //Append comments to DIV to be displayed on the account page
          $('.Comments').append("<hr>");
          $('.Comments').append("<p>" + "<strong>Comment:</strong> " + data[2][i] + "</p>\n");
          $('.Comments').append("<p>" + "<strong>Drink Title:</strong> " + data[3][i] + "</p>\n");
          $('.Comments').append("<p>" + "<strong>Made By:</strong> " + data[4][i] + "</p>\n");
        }
        $('.Comments').append("<hr>");


        //Get the number of liked drinks for the user
        if(data[5].username == 1){
          max = data[5].username;
        }
        else{
          max = data[5].username - 1;
        }

        //Loop through all the user's likes and append to the DIV to be displayed on the account page
        for(var i = 0; i < max; i++){

          //Hide likes if the user hasn't liked any drinks
          var contents = $('.Likes')[0]
          contents.style.display = "block";

          //Append likes to the DIV to be displayed on the account page
          if(i == 0){
            $('.Likes').append("<hr>");
          }
          $('.Likes').append("<p>" + "You liked the drink " + data[6][i] + " created by " + data[5][i] + "</p>\n");
        }
        $('.Likes').append("<hr>");


        //Get user's account information so it can be displayed (max should always equal 1)
        if(data[10].email == 1){
          max = data[10].email;
        }
        else{
          max = data[10].email - 1;
        }

        //Loop through account information and append to DIV to be displayed on the account page
        for(var i = 0; i < max; i++){

          //Append to DIV to be displayed on the account page
          $('.info').append("<hr>");
          $('.info').append("<p>" + "<strong>Name:</strong> " + data[8][i] + " " + data[9][i] + "</p>\n");
          $('.info').append("<p>" + "<strong>Birthday:</strong> " + data[7][i] + "</p>\n");
          $('.info').append("<p>" + "<strong>Email:</strong> " + data[10][i] + "</p>\n");
        }
        $('.info').append("<hr>");

    }
});
