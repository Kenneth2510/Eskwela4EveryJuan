$(document).ready(function () {
    const showPass = $("#showPwd");
    const hidePass = $("#hidePwd");
    const pwd = $("#password");

    showPass.on("click", function (event) {
        event.preventDefault();

        showPass.toggleClass("hidden");

        hidePass.toggleClass("hidden");
        pwd.prop("type", "text");
    });

    hidePass.on("click", function (event) {
        event.preventDefault();

        showPass.toggleClass("hidden");

        hidePass.toggleClass("hidden");

        pwd.prop("type", "password");
    });
});
