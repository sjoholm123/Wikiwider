
 $(function() {
    var expanded = false;
      $('.skapa').click(function() {
        if (!expanded) {
          $(".new-article").css("visibility", "visible");
          $( ".Title" ).show(0);
          $( ".table" ).hide(0);
          $(".container").hide(0);
          $(".fakeContainer").show(0);
          $('.menu').animate({'left' : '-30vw'}, {duration : 250});
          expanded = true;
      } else {
          $(".new-article").css("visibility", "visible");
          $( ".Title" ).show(0);
          $( ".table" ).hide(0);
          $(".container").hide(0);
          $(".fakeContainer").show(0);
          $('.menu').animate({'left' : '-30vw'}, {duration : 250});
          expanded = false;
      }
    });
  });
  
  $(function() {
    var expanded = false;
      $('.cancel').click(function() {
        if (!expanded) {
          $(".new-article").css("visibility", "hidden");
          $(".cancel").css("transition", "0s");
          $(".article-submit").css("transition", "0s");
          $( ".Title" ).hide(0);
          $( ".table" ).show(0);
          $(".container").show(0);
          $(".fakeContainer").hide(0);
          expanded = true;
      } else {
          $(".new-article").css("visibility", "hidden");
          $(".cancel").css("transition", "0s");
          $(".article-submit").css("transition", "0s");
          $( ".Title" ).hide(0);
          $( ".table" ).show(0);
          $(".container").show(0);
          $(".fakeContainer").hide(0);
          expanded = false;
      }
    });
  });