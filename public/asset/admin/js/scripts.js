$(function () {
    $('#previewImage').click(function () {
        $('#image').click();
    });
    $('#previewBannerImage').click(function () {
        $('#image').click();
    });
    $('#previewImageDetail').click(function () {
        $('#images').click();
    })
});

// Preview image (single image)
function previewImage() {
    $('#previewImage').html("<img width='100%' src='" + URL.createObjectURL(event.target.files[0]) + "'>");
}
function previewImage() {
    $('#previewBannerImage').html("<img width='100%' src='" + URL.createObjectURL(event.target.files[0]) + "'>");
}
function previewEditImage() {
    $('.edit-image > img').attr("src", URL.createObjectURL(event.target.files[0]));
}

function previewImageDetail(e) {
    var total_file = document.getElementById("images").files.length;
    var html = '';
    for (var i = 0; i < total_file; i++) {
        html += "<div id='image" + i + "' class='image'>";
        html += "<img height='260px' src='" + URL.createObjectURL(e.target.files[i]) + "'>";
        html += "<a class='delete-img'></a></div>";
    }
    alert(html);
    $('#previewImageDetail').html(html);
}

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


//Add row in product option
$(document).ready(function () {
    var i = $("#myTable > tbody > tr").length - 1;

    // Add row in product's option
    $("#add-option").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="col-md-5 col-lg-5"><input type="text" class="form-control" name="option_name[' + i + ']"/></td>';
        cols += '<td class="col-md-5 col-lg-5"><input type="text" class="form-control" name="option_value[' + i + ']"/></td>';
        cols += '<td><a id="ibtnDel" class="btn btn-md btn-danger"><i class="fas fa-trash-alt"></i></a></td>';
        cols += '</tr>';
        newRow.append(cols);
        $("#options").append(newRow);
        i++;
    });

    // Add row in product's type
    $("#add-type").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="col-md-5 col-lg-5"><input required type="text" class="form-control" name="product_type_name[' + i + ']"/></td>';
        cols += '<td class="col-md-2 col-lg-2"><input required type="text" class="form-control" name="product_type_stock_price[' + i + ']"/></td>';
        cols += '<td class="col-md-2 col-lg-2"><input required type="text" class="form-control" name="product_type_promotion_price[' + i + ']"/></td>';
        cols += '<td class="col-md-2 col-lg-2"><input required type="text" class="form-control" name="product_type_stock[' + i + ']"/></td>';
        cols += '<td><a id="ibtnDel" class="btn btn-md btn-danger"><i class="fas fa-trash-alt"></i></a></td>';
        cols += '</tr>';
        newRow.append(cols);
        $("#types").append(newRow);
        i++;
    });

    // Delete row in product's option
    $("#options").on("click", "#ibtnDel", function (event) {
        $(this).closest("tr").remove();
        i -= 1;
    });

    // Delete row in product's type
    $("#types").on("click", "#ibtnDel", function (event) {
        $(this).closest("tr").remove();
        i -= 1;
    });

    // Close modal popup
    $('#btn-close-modal').click(function (e) {
        $('.modal').modal('hide');
    });

    // Select picker
    $('select').selectpicker();

    // Config datatable
    $('#table').DataTable({
        "language": {
            "search": "Tìm kiếm",
            "paginate": {
                "next": "Sau",
                "previous": "Trước",
            },
            'info': 'Hiển thị từ _START_ tới _END_ trên tổng _TOTAL_ bản ghi',
            'lengthMenu': 'Hiển thị _MENU_ bản ghi',
            'order': [[0, "DESC"]]
        },
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'order': [[0, "DESC"]],
        'info': true,
        'autoWidth': true,
    })
});

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
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});
//end preview image when change

//delete image while upload
$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#images").on("change", function (e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    $("<div class='pip'>" +
                        "<img class='imageThumb' src='" + e.target.result + "'>" +
                        "<div class='delete-img'><button class='btn btn-danger'><i class='fas fa-trash-alt' id='icon-delete-image'></i></button></div>" +
                        "</div>").insertAfter("#previewImageDetail");
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
});
$(window).on('resize', function () {
    if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
});
//End calender in admin home




