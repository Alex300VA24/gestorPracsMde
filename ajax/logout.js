$(document).ready(function () {
    $(document).off("click", "#btnLogout").on("click", "#btnLogout", function (e) {
        $.ajax({
            url: './controllers/autenticacion/logout.php',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    location.reload();
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })
    })
})