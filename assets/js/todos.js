$(document).ready(function () {
  // Click On Add Todo

  $("#addTodo").click(function () {
    let inputDate = $("#datepicker").val();
    let inputDesc = $("#tododesc").val();
    let inputName = $("#todoname").val();
    let template = "";
    if (
      inputDate.length == 0 ||
      inputDesc.length == 0 ||
      inputName.length == 0
    ) {
      $(".notify")
        .html("Add Todo Info")
        .addClass("alert-warning")
        .removeClass("alert-danger alert-success")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1000);
      return;
    }
    // Add Todo
    $.ajax("/controllers/TodoController.php", {
      type: "POST",
      cache: false,
      crossDomain: false,
      dataType: "json",
      data: {
        name: inputName,
        description: inputDesc,
        date: inputDate,
        type: "add",
      },
    })
      .then((res) => {
        if (res.status == 1) {
          template += `
           <div class="form-group text-left bg-light shadow p-3" data-todoId="${res.message.id}">
                <div class="d-flex justify-content-between">
                    <span class="todo-name"> <i class="fas fa-angle-double-right mr-1"></i>
                        ${res.message.todoName}
                    </span>
                    <span class="arrow text-dark"> <span class="date mr-2">${res.message.todoDate}</span>
                        <i class="fa fa-chevron-down"></i>
                    </span>
                </div>
                <div class=" mt-4 todo-detailes">
                    <p class="todo-desc">
                         ${res.message.todoDescription}
                    </p>
                    <span class="options float-right">
                        <i class="fa fa-edit text-success px-2"></i>
                        <i class="fa fa-trash-alt text-danger"></i>
                    </span>
                </div>
        </div>`;
          $(".notify")
            .html("Todo Addedd Successfully")
            .addClass("alert-success")
            .removeClass("alert-danger alert-warning")
            .animate({ top: "10%" }, 800);
          setTimeout(function () {
            $(".notify").animate(
              {
                top: "-20%",
              },
              1000
            );
          }, 500);
          $(".todoInfo span").text(
            parseInt($(".todoInfo span").text().trim()) + 1
          );
          $(".list-todos").append(template);
          $("input").val("");
          $(this).prev().wrap("<form></from>").reset();
        } else if (res.status == 2) {
          $(".notify")
            .html(res.message)
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
          }, 1000);
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
          setTimeout(function () {
            $(".notify").animate(
              {
                top: "-20%",
              },
              800
            );
          }, 1000);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  });

  // Show Todo Detailles

  $(".list-todos").on("click", ".arrow i", function (e) {
    e.stopPropagation();
    $(this).toggleClass("fa-chevron-up fa-chevron-down");
    $(this).parent().parent().next().slideToggle(400);
  });

  // Delete TODO

  $(".list-todos").on("click", ".options i:last-of-type", function () {
    let id = $(this).parent().parent().parent().attr("data-todoId");
    $.ajax("/functions/todosOperation.php", {
      type: "post",
      dataType: "json",
      data: {
        type: "delete",
        todoId: id,
      },
    })
      .then((res) => {
        if (res.status) {
          $(".notify")
            .html("Todo Removed Successfully")
            .addClass("alert-success")
            .removeClass("alert-danger alert-warning")
            .animate({ top: "10%" }, 800);
          setTimeout(function () {
            $(".notify").animate(
              {
                top: "-20%",
              },
              1000
            );
          }, 500);
          $(".todoInfo span").text(
            parseInt($(".todoInfo span").text().trim()) - 1
          );
          $(".list-todos").find(`div[data-todoId=${id}]`).remove();
        } else {
          $(".notify")
            .html("Something Wrong Try Again !")
            .addClass("alert-danger")
            .removeClass("alert-success alert-warning")
            .animate({ top: "10%" }, 800);
          setTimeout(function () {
            $(".notify").animate(
              {
                top: "-20%",
              },
              800
            );
          }, 1000);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  });

  // Update TODO In Form

  $(".list-todos").on("click", ".options i:first-of-type", function () {
    $todoId = $(this).parent().parent().parent().attr("data-todoId");
    $todoname = $(this).parent().parent().prev().children().first().text();
    $tododate = $(this).parent().parent().prev().find(".date").text();
    $todoDesc = $(this).parent().prev().text();

    $("#todoname").val($todoname.trim());
    $("#tododesc").val($todoDesc.trim());
    $("#datepicker").val($tododate.trim());
    $("#addTodo").fadeOut(400, function () {
      $("#updateTodo").attr("data-todoId", $todoId).fadeIn();
    });
  });

  // Upate TODO On Database
  $("#updateTodo").click(function () {
    let inputDate = $("#datepicker").val();
    let inputDesc = $("#tododesc").val();
    let inputName = $("#todoname").val();
    var todoId = $(this).attr("data-todoId");
    if (
      inputDate.length == 0 ||
      inputDesc.length == 0 ||
      inputName.length == 0
    ) {
      $(".notify")
        .html("Add Todo Info")
        .addClass("alert-warning")
        .removeClass("alert-danger alert-success")
        .animate({ top: "10%" }, 800);
      setTimeout(function () {
        $(".notify").animate(
          {
            top: "-20%",
          },
          800
        );
      }, 1000);
      return;
    }
    // Update Todo
    $.ajax("/controllers/TodoController.php", {
      type: "POST",
      cache: false,
      crossDomain: false,
      dataType: "json",
      data: {
        id: todoId,
        name: inputName,
        description: inputDesc,
        date: inputDate,
        type: "update",
      },
    }).then((res) => {
      if (res.status == 1) {
        $(".notify")
          .html("Update Todo Successfully")
          .addClass("alert-success")
          .removeClass("alert-danger alert-warning")
          .animate({ top: "10%" }, 800);
        setTimeout(function () {
          $(".notify").animate(
            {
              top: "-20%",
            },
            800
          );
        }, 1000);

        // Fill Updated Data
        let ourElem = $(".list-todos").find(`[data-todoId=${todoId}]`);
        ourElem.find(".todo-name span").text(inputName.trim());
        ourElem.find(".date").text(inputDate.trim());
        ourElem.find(".todo-desc").text(inputDesc.trim());
        $("input").val("");
        $(this).prev().wrap("<form></from>").reset();
      } else if (res.status == 2) {
        $(".notify")
          .html(res.message)
          .addClass("alert-warning")
          .removeClass("alert-danger alert-success")
          .animate({ top: "10%" }, 800);
        setTimeout(function () {
          $(".notify").animate(
            {
              top: "-20%",
            },
            800
          );
        }, 1000);
      } else {
        let errors = "";
        for (let key in res.message) {
          errors += "* " + res.message[key] + "</br>";
        }
        $(".notify")
          .html(errors)
          .addClass("alert-danger")
          .removeClass("alert-warning alert-success")
          .animate({ top: "10%" }, 800);
        setTimeout(function () {
          $(".notify").animate(
            {
              top: "-20%",
            },
            800
          );
        }, 1000);
      }
    });
  });
});
