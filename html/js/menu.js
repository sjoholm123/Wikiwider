$(function()
{
  var expanded = false;
  $('#one').click(function()
                      {
                          if (!expanded)
                          {
                            $('#one').css({"box-shadow": " 0vw 0vh 1.5vw red"});
                              $('#two').animate({'top' : '10.5vh'}, {duration : 250});
                              $('#three').animate({'top' : '18.5vh'}, {duration : 250});
                              $( "#two" ).show();
                              $( "#three" ).show();
                              expanded = true;
                          }
                          else
                          {
                            $('#one').css({"box-shadow": "none"});
                             $('#two').animate({'top' : '2.5vh'}, {duration: 200});
                              $('#three').animate({'top' : '2.5vh'}, {duration : 200});
                              $( "#two" ).hide(0);
                              $( "#three" ).hide(0);
                              expanded = false;
                          }
                      });
    
                      
 });
