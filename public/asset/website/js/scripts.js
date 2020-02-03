$(document).ready(function () {
    $('#avatar').click(function () {
        $('#img').click();
    });
});

//Tab link
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace("active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
//End tab-link


//Add row in product option
$(document).ready(function () {
    var i = $("#myTable > tbody > tr").length - 1;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="col-md-5 col-lg-5"><input type="text" class="form-control" name="option_name[' + i + ']"/></td>';
        cols += '<td class="col-md-5 col-lg-5"><input type="text" class="form-control" name="option_value[' + i + ']"/></td>';
        cols += '<td><a id="ibtnDel" class="btn btn-md btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a></td>';
        cols += '</tr>';
        newRow.append(cols);
        $("#options").append(newRow);
        i++;
    });

    $("#options").on("click", "#ibtnDel", function (event) {
        $(this).closest("tr").remove();
        i -= 1;
    });
});
//End add row in product option

$(document).ready(function () {
    $('select').selectpicker();
});

// Preview image
function preview_ava() {
    $('#preview').append("<img height='250px' src='" + URL.createObjectURL(event.target.files[0]) + "'>");
}

function preview_image() {
    var total_file = document.getElementById("files").files.length;
    for (var i = 0; i < total_file; i++) {
        $('#gallery').append("<div id='image" + i + "' class='image'><img height='250px' src='" + URL.createObjectURL(event.target.files[i]) + "'><a class='delete-img'></a></div>");
    }
}

//End preview image

//Preview image when change
$(function () {
    $('#upload').change(function () {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
});
//end preview image when change

//delete image while upload
$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $("<div class='pip'>" +
                        "<img class='imageThumb' src='" + e.target.result + "'>" +
                        "<div class='delete-img'><span class='glyphicon glyphicon-remove-sign' id='icon-delete-image'></span></div>" +
                        "</div>").insertAfter("#files");
                    $(".delete-img").click(function () {
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});
//end

//Calender in admin home
$('#calendar').datepicker({});

!function ($) {
    $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
        $(this).find('em:first').toggleClass("glyphicon-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
}(window.jQuery);

$(window).on('resize', function () {
    if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
    if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})
//End calender in admin home




