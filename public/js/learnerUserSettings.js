$(document).ready(function () {
    $("#showLearnerPersonal").on("click", () => {
        $("#learnerPersonal").toggleClass("hidden");
    });
    $("#showLearnerLogin").on("click", () => {
        $("#learnerLogin").toggleClass("hidden");
    });
    $("#showLearnerBusiness").on("click", () => {
        $("#learnerBusiness").toggleClass("hidden");
    });

    const fname = $("#learner_fname");
    const lname = $("#learner_lname");
    const gender = $("#learner_gender");
    const bday = $("#learner_bday");
    const email = $("#learner_email");
    const contactno = $("#learner_contactno");
    const username = $("#learner_username");
    const password = $("#password");
    const password_confirmForm = $("#password_confirmForm");

    const business_name = $("#business_name");
    const bplo_account_number = $("#bplo_account_number");
    const business_address = $("#business_address");
    const business_owner_name = $("#business_owner_name");

    const editBtn = $("#editBtn");
    const updateBtn = $("#updateBtn");
    const cancelBtn = $("#cancelBtn");

    $("#editBtn").on("click", () => {
        $("#learnerPersonal").toggleClass("hidden");
        $("#learnerBusiness").toggleClass("hidden");

        fname.prop("disabled", false);
        fname.attr("autofocus", "autofocus");

        lname.prop("disabled", false);
        bday.prop("disabled", false);
        gender.prop("disabled", false);

        business_name.prop("disabled", false);
        business_address.prop("disabled", false);
        business_owner_name.prop("disabled", false);

        password_confirmForm.removeClass("hidden");

        editBtn.addClass("hidden");
        updateBtn.removeClass("hidden");
        cancelBtn.removeClass("hidden");
    });

    $(cancelBtn).on("click", (e) => {
        window.location.reload();
    });

    $("#updatePictureBtn").click(function () {
        $("#profilePicturePopup").removeClass("hidden");
    });

    $("#closePopup").click(function () {
        $("#profilePicturePopup").addClass("hidden");
    });
});
