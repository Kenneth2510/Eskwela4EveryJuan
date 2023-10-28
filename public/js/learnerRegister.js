// $(document).ready(() => {
//     $("#learnerNextBtn").on("click", (event) => {
//         event.preventDefault();

//         $("#learnerPersonalInfo").addClass("hidden");
//         $("#learnerBusinessInfo").removeClass("hidden");
//     });

//     $("#learnerBackBtn").on("click", (event) => {
//         event.preventDefault();

//         $("#learnerPersonalInfo").removeClass("hidden");
//         $("#learnerBusinessInfo").addClass("hidden");
//     });
// });


$(document).ready(function() {
    const form1 = $('#personinfo');
    const form2 = $('#businessinfo');
    const form3 = $('#securityCodeForm');
    const gotoForm2Button = $('#nextBtn');
    const gobackForm1Button = $('#prevBtn');
    const gotoForm3Button = $('#nextBtn2');
    const gobackForm2Button = $('#prevBtn2');

    gotoForm2Button.on('click', function(event) {
        event.preventDefault();
        form1.addClass('hidden');
        form2.removeClass('hidden');
    });

    gobackForm1Button.on('click', function(event) {
        event.preventDefault();
        form2.addClass('hidden');
        form1.removeClass('hidden');
    });


    gotoForm3Button.on('click', function(event) {
        event.preventDefault();
        form2.addClass('hidden');
        form3.removeClass('hidden');
    });

    gobackForm2Button.on('click', function(event) {
        event.preventDefault();
        form3.addClass('hidden');
        form2.removeClass('hidden');
    });

});