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
