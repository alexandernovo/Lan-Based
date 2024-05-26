$(document).ready(function () {
    $(document).on('input', '.modal input', function () {
        const capitalizer = (element) => {
            let inputValue = $(element).val();

            if (inputValue.length > 0) {
                inputValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);
                $(element).val(inputValue);
            }
        };

        // Bind the capitalizer function to the input event for all input elements inside modals
        capitalizer(this);
    });


    const capitalizer = (element) => {
        let inputValue = $(element).val();

        if (inputValue.length > 0) {
            inputValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);
            $(element).val(inputValue);
        }
    };
});

function printDiv(divId) {
    var printContents = $('#' + divId).html();
    var originalContents = $('body').html();

    // Create a temporary div to hold the content
    var tempDiv = $('<div>').css({
        'position': 'absolute',
        'top': '20%',
        'left': '50%',
        'width': '100%',
        'transform': 'translate(-50%, -50%)',
    });

    // Set the HTML content of the temporary div
    tempDiv.html(printContents);

    // Append the temporary div to the body
    $('body').empty().append(tempDiv);

    // Print the content
    window.print();

    // Restore original contents after printing
    $('body').html(originalContents);
}
