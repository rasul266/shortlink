$(document).ready(function () {

    $('#generate').click(function () {

        $.ajax({
            url: '/link/generate',
            type: 'POST',
            data: {
                url: $('#url').val()
            },
            success: function (res) {

                if (res.error) {
                    $('#result').html('<div class="alert alert-danger">' + res.error + '</div>');
                    return;
                }

                $('#result').html(`
                    <p>Короткая ссылка:</p>
                    <a href="${res.short_url}" target="_blank">${res.short_url}</a>
                    <br><br>
                    <img src="${res.qr}">
                `);

            }
        });

    });

});