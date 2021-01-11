$(function() {
  var expanded = false;
    $('#signingUp').click(function() {
      if (!expanded) {
        $(".register-form").css("visibility", "visible");
        $(".login-form").css("visibility", "hidden");
        $(".register").show();
        $(".login").hide();
        $(".password-label").css("transition", "0.2s");
        $(".username-label").css("transition", "0.2s");
        $(".login-btn").css("transition", "0.2s");
        expanded = true;
    } else {
        $(".register-form").css("visibility", "visible");
        $(".login-form").css("visibility", "hidden");
        $(".register").show();
        $(".login").hide();
        $(".password-label").css("transition", "0.2s");
        $(".username-label").css("transition", "0.2s");
        $(".login-btn").css("transition", "0.2s");
        expanded = false;
    }
  });
});
 $(function() {
  var expanded = false;
    $('#cross').click(function() {
      if (!expanded) {
        $(".register-form").css("visibility", "hidden");
        $(".password-label").css("transition", "0s");
        $(".username-label").css("transition", "0s");
        $(".login-btn").css("transition", "0s");
        $(".register").hide();
        expanded = true;
    } else {
        $(".register-form").css("visibility", "hidden");
        $(".password-label").css("transition", "0s");
        $(".username-label").css("transition", "0s");
        $(".login-btn").css("transition", "0s");
        $(".register").hide();
        expanded = false;
    }
  });
});



$(function() {
  var expanded = false;
    $('#loggingIn').click(function() {
      if (!expanded) {
        $(".login-form").css("visibility", "visible");
        $(".register-form").css("visibility", "hidden");
        $(".password-label").css("transition", "0.2s");
        $(".username-label").css("transition", "0.2s");
        $(".login-btn").css("transition", "0.2s");
        $(".register").hide();
        $(".login").show()
        expanded = true;
    } else {
        $(".login-form").css("visibility", "visible");
        $(".register-form").css("visibility", "hidden");
        $(".password-label").css("transition", "0.2s");
        $(".username-label").css("transition", "0.2s");
        $(".login-btn").css("transition", "0.2s");
        $(".register").hide();
        $(".login").show();
        expanded = false;
    }
  });
});

$(function() {
  var expanded = false;
    $('#cancel').click(function() {
      if (!expanded) {
        $(".login-form").css("visibility", "hidden");
        $(".password-label").css("transition", "0s");
        $(".username-label").css("transition", "0s");
        $(".login-btn").css("transition", "0s");
        $(".login").hide();
        expanded = true;
    } else {
        $(".login-form").css("visibility", "hidden");
        $(".password-label").css("transition", "0s");
        $(".username-label").css("transition", "0s");
        $(".login-btn").css("transition", "0s");
        $(".login").hide();
        expanded = false;
    }
  });
});