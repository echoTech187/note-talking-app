$(document).ready(function () {
    $('#signinFrm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (response.success) {
                    toastr.success('Selamat datang di Note Talking');
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 3000);

                } else {
                    toastr.error(response.message);
                }

            },
            error: function (response) {
                toastr.error(response.message);
            }
        });
        return false;
    })
})