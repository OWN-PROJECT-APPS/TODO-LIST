$(document).ready(function () {
  $(".form-window").css({
    left: "50%",
  });

  //Send Data Validate To Server

  $("#form-login").submit(function (e) {
    e.preventDefault();
    var credentiels = $(this).serialize();
    if ($(this).find("#username").val().length == 0) {
      $(".notify")
        .addClass("alert-warning")
        .removeClass("alert-success alert-danger")
        .html("Add Email.")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1500);
    } else if ($(this).find("#password").val().length == 0) {
      $(".notify")
        .html("Add Password.")
        .addClass("alert-warning")
        .removeClass("alert-success alert-danger")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1500);
    } else {
      $.ajax({
        url: "controllers/LoginController.php",
        type: "POST",
        dataType: "json",
        data: credentiels,
      }).then(
        (res) => {
          if (res.status == 1) {
            $(".notify")
              .html("Login Successfully.")
              .addClass("alert-success")
              .removeClass("alert-danger alert-warning")
              .animate({ top: "10%" }, 800);
            window.location.href = res.message;
          } else if (res.status == 2) {
            $(".notify")
              .html(res.message)
              .addClass("alert-warning")
              .removeClass("alert-success alert-danger")
              .animate({ top: "10%" }, 800);
          } else {
            let errors = "";
            for (let key in res.message) {
              errors += "* " + res.message[key] + "</br>";
            }
            $(".notify")
              .html(errors)
              .addClass("alert-danger")
              .removeClass("alert-success alert-warning")
              .animate({ top: "10%" }, 800);
          }
          setTimeout(function () {
            $(".notify").animate(
              {
                top: "-20%",
              },
              800
            );
          }, 1000);
        },
        (err) => {
          console.log("error");
        }
      );
    }
  });

  $(".register").click(function (e) {
    e.preventDefault();
    var currentForm = $(this).data("current-form");
    var registerForm = $(this).data("link");
    $(currentForm).animate(
      {
        left: "-80%",
      },
      500,
      function () {
        $(registerForm).animate(
          {
            top: "30%",
          },
          700
        );
      }
    );
  });

  $(".go-back").click(function (e) {
    var loginForm = $(this).data("login-form");
    var registerF = $(this).data("register-form");
    $(registerF).animate(
      {
        top: "-150%",
      },
      200,
      function () {
        $(loginForm).animate(
          {
            left: "50%",
          },
          200
        );
      }
    );
  });

  // Start Register

  $("#registerform").submit(function (e) {
    e.preventDefault();
    var fullName = $(this).find("#fullname").val();
    var registerEmail = $(this).find("#registeremail").val();
    var passwordRegister = $(this).find("#registerpassword").val();
    var repeatPassword = $(this).find("#registerpasswordconf").val();
    var credentiels = $(this).serialize();
    if (fullName.length == 0) {
      $(".notify")
        .addClass("alert-warning")
        .removeClass("alert-success alert-danger")
        .html("Add Fullname.")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1500);
    } else if (registerEmail.length == 0) {
      $(".notify")
        .addClass("alert-warning")
        .removeClass("alert-success alert-danger")
        .html("Add Email.")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1500);
    } else if (passwordRegister.length == 0) {
      $(".notify")
        .addClass("alert-warning")
        .removeClass("alert-success alert-danger")
        .html("Add Password.")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1500);
    } else if (passwordRegister !== repeatPassword) {
      $(".notify")
        .addClass("alert-warning")
        .removeClass("alert-success alert-danger")
        .html("Password Not Matched.")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1500);
    } else {
      $.ajax({
        url: "controllers/RegisterController.php",
        type: "POST",
        dataType: "json",
        data: credentiels,
      }).then(
        (res) => {
          if (res.status == 1) {
            $(".notify")
              .addClass("alert-success")
              .removeClass("alert-warning alert-danger")
              .html("Success Login.")
              .animate({ top: "10%" }, 800);
            window.location.href = res.message;
          } else if (res.status == 2) {
            $(".notify")
              .addClass("alert-warning")
              .removeClass("alert-success alert-danger")
              .html(res.message)
              .animate({ top: "10%" }, 800);
          } else if (res.status == 3) {
            let errors = "";
            for (let key in res.message) {
              errors += "* " + res.message[key] + "</br>";
            }
            $(".notify")
              .addClass("alert-danger")
              .removeClass("alert-success alert-warning")
              .html(errors)
              .animate({ top: "10%" }, 800);
          }
          setTimeout(function () {
            $(".notify").animate(
              {
                top: "-20%",
              },
              800
            );
          }, 1500);
        },
        (err) => {
          console.log("error");
        }
      );
    }
  });
});
