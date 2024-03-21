$(document).ready(function () {
    $(".dropdown-toggle").dropdown();
    $(document).on("click", ".approve-user", function (event) {
        const button = $(this);
        const userId = button.data("user_id");
        const row = button.closest("tr");

        $.ajax({
            url: APP_URL + "/admin/user/add/" + userId,
            type: "GET",
            dataType: "json",

            success: function (data) {
                if (data.type == "success") {
                    toastr.success(data.msg);
                    row.remove();
                    renumberRows();
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    });
    $(document).on("click", ".decline-user", function (event) {
        const button = $(this);
        const userId = button.data("user_id");
        const row = button.closest("tr");

        $.ajax({
            url: APP_URL + "/admin/user/delete/" + userId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.type == "success") {
                    toastr.warning(data.msg);
                    row.remove();
                    renumberRows();
                } else {
                    toastr.error(data.msg);
                }
            },
        });
    });

    function renumberRows() {
        $(".tbody-light tr").each(function (index) {
            $(this)
                .find("td:first")
                .text(index + 1);
        });
    }
});
