$(document).ready(function () {
    const showPass = $("#showPwd");
    const hidePass = $("#hidePwd");
    const pwd = $("#password");

    // const loginBtn = $("#loginBtn");
    // const loginForm = $("#loginForm");
    // const securityForm = $("#securityForm");

    const backBtn = $("#backBtn");

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

    // loginBtn.on("click", function (event) {
    //     event.preventDefault();

    //     loginForm.addClass("hidden");
    //     securityForm.removeClass("hidden");
    // });

    // backBtn.on("click", function (event) {
    //     event.preventDefault();

    //     loginForm.removeClass("hidden");
    //     securityForm.addClass("hidden");
    // });
});
