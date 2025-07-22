$(document).ready(function () {
    $('button#upload-button').click(function () {
        $('input#avatar').click();
    })

    $('#avatar').change(function () {

        let reader = new FileReader();

        reader.onload = (e) => {
            $('img#userAvatar').attr('src', e.target.result);

        }
        reader.readAsDataURL(this.files[0]);
    })

    $("#profileUpdateFrm").on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            Headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (data) {
                if (data.responseStatus) {
                    // window.location.href = '/profile';
                } else {
                    alert(data.responseMessage);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
        return false;
    })


})