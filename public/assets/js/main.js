function Success(message) {
    Swal.fire({
        position: "center-center",
        icon: "success",
        text: message,
        showConfirmButton: !1,
        timer: 2000,
    });
}

function toast_message(notes, message,confirm){

    Swal.fire({
        title: notes,
        text: message,
        icon: "warning",
        confirmButtonColor: "#1cbb8c",
        confirmButtonText: confirm
    })
}

$(".choosse-input").on("click", ".choosse", function () {
    $(this).closest(".choosse-input").find(".choosse").removeClass("clickable");
    $(this).closest(".choosse-input").find(".choosse").find("i").hide(0);

    $(this).find("i").fadeIn();
    $(this).addClass("clickable");
});


$(".euhgiuerhgerg").keyup(function (e) {
    var v = $(this).val();
    console.log(v);
    if (v != "") {
        if (v.charAt(0) == 1) {
            $(".country02").find("input[value='1']").prop("checked", true);
            $(".country02")
                .find("input[value='1']")
                .closest(".choosse")
                .addClass("clickable");
            $(".country02")
                .find("input[value='1']")
                .closest(".choosse")
                .find("i")
                .fadeIn();
            return;
        }
        $(".country02").find("input[value='1']").closest(".choosse").hide(0);
        $(".country02").find("input[value='1']").prop("checked", false);
        $(".country02")
            .find("input[value='1']")
            .closest(".choosse")
            .removeClass("clickable");
        $(".country02")
            .find("input[value='1']")
            .closest(".choosse")
            .find("i")
            .hide(0);
    }
});

function delete_tr(thiss,table,idd){

    var thiss = $(thiss);
    var id = thiss.data('id');
    
    Swal.fire({
        title: lang ? "هل أنت متأكد؟" : "Are you sure?",
        text: lang ? "هل تريد الحذف فعلا" : "Do you really want to delete?",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#1cbb8c",
        cancelButtonColor: "#f14e4e",
        confirmButtonText: lang ? "نعم إحذف !" : "Yes, delete it!",
        cancelButtonText: lang ? "إلغاء" : "Cancel",
    }).then(function(t) {
        if(t.value){
            $.get('/delete_tr',{id,table},function(e){
                $("#"+idd).fadeOut(500);
            });
        }
    })


    
}

$(document).ready(function (e) {
    $(".choosse-input").each(function (index) {
        var th = $(this).data("select");
        if (th != "") {
            $(this)
                .find("input[value='" + th + "']")
                .prop("checked", true);
            $(this)
                .find("input[value='" + th + "']")
                .closest(".choosse")
                .addClass("clickable");
            $(this)
                .find("input[value='" + th + "']")
                .closest(".choosse")
                .find("i")
                .fadeIn();
        }
    });

    $(".checkbox2").each(function (index) {
        var th = $(this).data("select");
        var ele = $(this);
        if (th != "[]") {
            $.each(th, function (index, value) {
                console.log(value.id);
                ele.find("input[value='" + value.id + "']").prop(
                    "checked",
                    true
                );
                var id = ele.find("input[value='" + value.id + "']").attr("id");
                ele.find("label[for='" + id + "']")
                    .addClass("clickable")
                    .find("i")
                    .fadeIn();
            });
        }
    });
});
