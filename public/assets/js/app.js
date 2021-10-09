function getDataFile() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    respuesta = false;
    url = '/parseFile/getDataFile';
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        data:{
            fileTxt : $('input[name=file]').val(),
        },
        success: function (json) {
            console.log(json);
            $('#show_table').html(json.html);

            $('.progress .progress-bar').css("width", '0%', function() {
                return $(this).attr("aria-valuenow", '0') + "%";
            })

        }
    });
}

$(function () {
    $(document).ready(function () {
        $('#fileUploadForm').ajaxForm({
            beforeSend: function () {
                var percentage = '0';
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentage = percentComplete;
                $('.progress .progress-bar').css("width", percentage+'%', function() {
                    return $(this).attr("aria-valuenow", percentage) + "%";
                })
            },
            complete: function (xhr) {
                getDataFile();
            }
        });
    });
});
