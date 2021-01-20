
 $(function() {
    var expanded = false;
      $('#signingUp').click(function() {
        if (!expanded) {
          $( ".register" ).show(0);
          expanded = true;
      } else {
          $( ".register" ).hide(0);
          expanded = false;
      }
    });
  });
