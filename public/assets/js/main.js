$(document).ready(function () {
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

});


$(document).ready(function () {

    const $input = $('#image-upload');
    const $preview = $('#preview-image');
    const $container = $('#image-container');

    $input.on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', function () {
                $preview.attr('src', reader.result);
            });
            reader.readAsDataURL(file);
        }
        else {
            $preview.attr('src', '#');
        }
    });

    $container.on('dragover', function (e) {
        e.preventDefault();
        $container.addClass('dragover');
    });

    $container.on('dragleave', function (e) {
        e.preventDefault();
        $container.removeClass('dragover');
    });

    $container.on('drop', function (e) {
        e.preventDefault();
        $container.removeClass('dragover');
        const file = e.originalEvent.dataTransfer.files[0];
        if (file.type.match(/^image\//)) {
            const reader = new FileReader();
            reader.addEventListener('load', function () {
                $preview.attr('src', reader.result);
            });
            reader.readAsDataURL(file);
        }
    });
});


$(document).ready(function () {
    $('#people').on('click', '#userid_all', function () {
        $('.userid').prop('checked', this.checked);
    });
});


$("#close-broadcast").on("click", function () {
    $("#liveToast").hide();
});


$(document).ready(function () {
    document.getElementById('dropdownMenuLink').addEventListener('click', function (event) {
        event.preventDefault();
        var dropdownMenu = this.nextElementSibling;
        if (dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        } else {
            dropdownMenu.classList.add('show');
        }
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', function (event) {
        var dropdown = document.querySelector('.dropdown-menu');
        if (!event.target.matches('#dropdownMenuLink')) {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    });
})



function showPopup(id) {
    var $popup = $(`#${id}`);
    $popup.toggleClass('show');
}

$(document).ready(function () {
    $('body').on('click', function (e) {
        $('.popup').each(function () {
            if (!$(e.target).closest(this).length) {
                $(this).removeClass('show');
            }
        });
    });

    // Prevent the popup from closing when clicking inside it
    $('.popup').on('click', function (e) {
        e.stopPropagation();
    });
    $('#dropdownMenuButton').on('click', function (e) {
        e.stopPropagation();
    });
});

$("#submission_disable").on('click', function () {
    $(".submission").prop("disabled", function (_, val) {
        return !val;
    });
});


$('#activity_click').on('click', function () {
    $('#activity_now').toggleClass('d-none');
    $('#activity_edit').toggleClass('d-none');
    if ($('#activity_now').hasClass('d-none')) {
        $(this).text('Cancel Edit');
    }
    else {
        $(this).text('Edit Submission');
    }
});


$(document).ready(function () {
    $('#copyButton').on('click', function () {
        var buttonText = $(this).attr('class-code');
        navigator.clipboard.writeText(buttonText).then(function () {
            alert('Class code has been copied: ' + buttonText);
        }).catch(function (err) {
            console.error('Could not copy text: ', err);
        });
    });
});

