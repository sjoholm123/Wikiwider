$(function()
{
  var expanded = false;
  $('#bars').click(function()
                      {
                          if (!expanded)
                          {
                              $('.menu').animate({'left' : '0vw'}, {duration : 250});
                              expanded = true;
                          }
                          else
                          {
                             $('.menu').animate({'left' : '0vw'}, {duration: 250});
                              expanded = false;
                          }
                      });
    
                      
 });

 $(function()
 {
   var expanded = false;
   $('#menuCross').click(function()
                       {
                           if (!expanded)
                           {
                               $('.menu').animate({'left' : '-30vw'}, {duration : 250});
                               expanded = true;
                           }
                           else
                           {
                              $('.menu').animate({'left' : '-30vw'}, {duration: 250});
                               expanded = false;
                           }
                       });
     
                       
  });