/*$('add').click(function () {

}) */


$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".form");
    var add_button = $("#add_subheader");
    var Scount = 1;

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append("<div><input type='text' name='postTitle' class='subheading' placeholder='Subheader "+ (Scount) +"'/><a href='#' class='delete'><img class='deleteIcon' src='bilder/delete.svg'></a></div>"); //add input box
            Scount++;
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        Scount--;
    })
});

$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".form");
    var add_button = $("#add_paragraph");
    Pcount = 1;

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            //add input box
            $(wrapper).append("<div><textarea class='paragraph' name='pText' cols='100' rows='20' placeholder='Paragraph "+ (Pcount) +"'></textarea><a href='#' class='deleteP'><img class='deleteIcon' src='bilder/delete.svg'></a></div>"); 
            Pcount++;
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".deleteP", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        Pcount--;
    })
});

$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".form");
    var add_button = $("#add_image");
    //Pcount = 1;

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            //add input box
            $(wrapper).append("<div><input class='image' type='file' accept=' image/png, image/jpeg'/><a href='#' class='deleteImg'><img class='deleteIcon' src='bilder/delete.svg'></a></div>"); 
            //Pcount++;
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".deleteImg", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        //Pcount--;
    })
});


$(document).ready(function() {
    var max_fields = 2;
    var wrapper = $(".form");
    var add_button = $("#add-infobox");
    //Pcount = 1;

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            //add input box
            $(wrapper).append("<div><table class='infobox'><tr><td class='infobox-title'><input type='text' class='title-info' placeholder='Infobox-title' name='postTitle'></td></tr><tr><td style='background-color: aqua; position: relative;'><label id='file' class='label-img' for='customFile'>Choose a file...</label><input id='customFile' class='inputfile' type='file' name='info-img' data-multiple-caption='{count} files selected' accept='Image/jpeg, Image/png'></td></tr><tr><td style='position: relative' white-space='nowrap'><textarea class='info' cols='29' rows='12' placeholder='Info'></textarea></td></tr></table><a href='#' class='deleteInfo'><img class='deleteIcon' src='bilder/delete-red.svg'></a></div>"); 
            //Pcount++;
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".deleteInfo", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        //Pcount--;
    })
});

/*$('#section').hover(
    () => {
        $(this).$(".yeet").css("display: show")
    },
    () => {
        $(this).$(".yeet").css("display: none")
    }

)*/

/*
var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( '\'' ).pop();

		if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});
*/

$('#customFile').on("change",function() {
    console.log("change fire");
   var i = $(this).prev('label').clone();
    var file = $('#customFile')[0].files[0].name;
 console.log(file);
    $(this).prev('label').text(file);
 
});