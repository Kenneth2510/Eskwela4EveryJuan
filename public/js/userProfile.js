$(document).ready(function() {
    $('#contactNumber').on('input', function() {
        var phoneNumber = $(this).val();
        // Replace any non-digit characters with empty string
        phoneNumber = phoneNumber.replace(/\D/g, '');
        // Check if the input starts with '09'
        if (phoneNumber.length >= 2 && phoneNumber.substring(0, 2) !== '09') {
            phoneNumber = '09' + phoneNumber.substring(2);
        }
        // Update the input value
        $(this).val(phoneNumber);
    });

    $('#bplo_account_number').on('input', function() {
        var phoneNumber = $(this).val();
        // Replace any non-digit characters with empty string
        phoneNumber = phoneNumber.replace(/\D/g, '');
        // Check if the input starts with '09'
        if (phoneNumber.length >= 2 && phoneNumber.substring(0, 2) !== '09') {
            phoneNumber = '09' + phoneNumber.substring(2);
        }
        // Update the input value
        $(this).val(phoneNumber);
    });
});