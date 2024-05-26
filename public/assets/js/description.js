$(document).ready(function () {
    $('#check-description').on("change", function () {
        if ($(this).is(":checked")) {
            console.log("Checkbox is checked");
            $('.customize-description').text("Shoulder:\nTorso:\nWaist:\nLegs:").show();
        } else {
            console.log("Checkbox is unchecked");
            $('.customize-description').text("");
        }
    });
});
