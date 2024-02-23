$(document).ready(function () {
    var cType = $("#contentType").val();
    $("#SelectContentType").val(cType);
    $("#SelectContentType").trigger("change");
});

function setContentType() {
    var cType = $("#SelectContentType").val();

    let input = "";
    if (cType == "text") {
        var Text = $("#text").val();
        if (Text == undefined) {
            Text = "";
        } else {
            Text = $("#text").val();
        }

        input =
            "<div class='mb-3'><label for='formrow-firstname-input' class='form-label'>  Text </label> <input type='text' name='content' id='content' class='form-control' value='" +
            Text +
            "' > </div>";
    } else if (cType == "content") {
        var content = $("#content").val();
        if (content == undefined) {
            content = "";
        } else {
            content = $("#content").val();
        }
        input =
            "<div class='mb-3'><label for='formrow-firstname-input' class='form-label'>  Content </label> <textarea name='content' id='content' class='form-control ckeditor' cols='5' rows='5'> " +
            content +
            " </textarea> </div>";
    } else if (cType == "links") {
        var label = $("#label").val();
        var link = $("#link").val();

        if (label == undefined || link == undefined) {
            label = "";
            link = "";
        } else {
            label = $("#label").val();
            link = $("#link").val();
        }
        input =
            "<div class='mb-3'> <label for='formrow-firstname-input' class='form-label'>  Label </label> <input type='text' name='label'  id='label' placeholder='label' class='form-control' value='" +
            label +
            "'> </div>";

        input +=
            "<div class='mb-3'> <label for='formrow-firstname-input' class='form-label'>  Link </label> <input type='text' name='content' id='link' placeholder='Link' class='form-control' value='" +
            link +
            "' ></div>";
    } else if (cType == "image") {
        input =
            "<div class='row'> <div class='col-sm-12'><input type='file' class='form-control mt-3 mb-3' name='content' /> </div>  </div>  ";
    }
    $(".cTypeData").html(input);
    // tinymce.init({
    //     selector: "textarea#content",
    //     height: 400,
    //     plugins: 'advcode',
    //     toolbar: 'code',
    //     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    // });
}

function updatePageContent(event) {
    //event.preventDefault();
    var formData = new FormData(event);
    // console.log(formData);
    var id = $("#id").val();
    $.ajax({
        url: route("pageContent.update", id),
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (result) {
            var message =
                '<div class="alert alert-' +
                result.type +
                ' alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i> ' +
                result.message +
                ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
            $(".message").html(message);
            if (result.type == "success") {
                window.location.href = route(
                    "pageContent.show",
                    $(document).find("#page_id").val()
                );
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
    return false;
}
