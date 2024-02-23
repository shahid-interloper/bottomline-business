function setContentType() {
    let cType = $("#c_type").val();
    let input = "";
    if (cType == "text") {
        input =
            "<div class='mb-3'><label for='formrow-firstname-input' class='form-label'>  Text </label> <input type='text' name='content' id='text' class='form-control' /> </div>";
    } else if (cType == "content") {
        input =
            "<div class='mb-3'><label for='content' class='form-label'>  Content </label> <textarea name='content' id='content' class='form-control'  cols='5' rows='5'></textarea></div>";
    } else if (cType == "links") {
        input =
            "<div class='mb-3'><label for='formrow-firstname-input' class='form-label'>  Label </label> <input type='text' name='label' id='label' class='form-control' /> </div>";
        input +=
            "<div class='mb-3'><label for='formrow-firstname-input' class='form-label'>  Link </label> <input type='text' name='content' id='link' class='form-control' /> </div>";
    } else if (cType == "image") {
        input =
            "<div class='row'> <div class='col-sm-6'>  <input type='file' class='form-control mt-3 mb-3' name='content' /> </div> <div class='col-sm-6'> <input type='text' class='form-control mt-3 mb-3' name='image_name' placeholder='image Name'/> </div> </div>  ";
    }
    $(".cTypeData").html(input);

    // tinymce.init({
    //     selector: 'textarea#content',
    //     height: 400,
    //     plugins: 'advcode',
    //     toolbar: 'code',
    //     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    // });
}

function addPageContent(event) {
    //event.preventDefault();
    var formData = new FormData(event);
    $.ajax({
        url: route("pageContent.store"),
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
            document.getElementById("frm").reset();
            // REFRESHING YAJRA DATA TABLE AFTER PAGE CONTENT STORED
            var table = $(".data-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: route("pageContent.index", { id: $("#page_id").val() }),
                columns: [
                    {
                        data: "key",
                        name: "key",
                    },
                    {
                        data: "content",
                        name: "content",
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                    },
                    {
                        data: "updated_at",
                        name: "updated_at",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
                responsive: true,
                createdRow: function (row, data, dataIndex) {
                    $(row).attr("id", data.id);
                },
                order: [[0, "desc"]],
                bDestroy: true,
            });
        },
        error: function (data) {
            $(".message").html(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="mdi mdi-check-all me-2"></i>' +
                    data.responseJSON.message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
            );
        },
    });
    return false;
}
