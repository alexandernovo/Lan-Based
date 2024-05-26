$(document).ready(function () {
    $('#add_studs').on('click', function () {
        const fetchYear = (id) => {
            $.ajax({
                url: `actions/manage_student.php`,
                type: 'GET',
                data: {
                    getYear: true,
                    Schools_ID: id
                },
                success: function (response) {
                    console.log('Response:', response);
                    let dataDiv = $('#year');
                    const years = response.data;
                    dataDiv.empty();
                    years.forEach(year => {
                        dataDiv.append(
                            `<option value="${year.Year_ID}">${year.Year}</option>`
                        );
                    });

                    // Call fetchSection here after the year data is loaded
                    fetchSection($('#year').val());
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        const fetchSection = (id) => {
            $.ajax({
                url: `actions/manage_student.php`,
                type: 'GET',
                data: {
                    getSection: true,
                    Year_ID: id
                },
                success: function (response) {
                    console.log('Response:', response);
                    let dataDiv = $('#section');
                    const sections = response.data;
                    dataDiv.empty();
                    sections.forEach(section => {
                        dataDiv.append(
                            `<option value="${section.Sections_ID}">${section.Sections_Name}</option>`
                        );
                    });
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        fetchYear($('#school').val());

        $('#school').on('change', function () {
            fetchYear($(this).val());
        })

        $('#year').on('change', function () {
            fetchSection($(this).val());
        })
    })











    $('.edit_studs').on('click', function () {
        const fetchYear = (id) => {
            $.ajax({
                url: `actions/manage_student.php`,
                type: 'GET',
                data: {
                    getYear: true,
                    Schools_ID: id
                },
                success: function (response) {
                    console.log('Response:', response);
                    let dataDiv = $('.year_edit');
                    const years = response.data;
                    dataDiv.empty();
                    years.forEach(year => {
                        dataDiv.append(
                            `<option ${dataDiv.attr('year-value') == year.Year_ID ? 'selected' : ''} value="${year.Year_ID}">${year.Year}</option>`
                        );
                    });

                    fetchSection(dataDiv.val());
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        const fetchSection = (id) => {
            $.ajax({
                url: `actions/manage_student.php`,
                type: 'GET',
                data: {
                    getSection: true,
                    Year_ID: id
                },
                success: function (response) {
                    console.log('Response:', response);
                    let dataDiv = $('.section_edit');
                    const sections = response.data;
                    dataDiv.empty();
                    sections.forEach(section => {
                        dataDiv.append(
                            `<option ${dataDiv.attr('section-value') == section.Sections_ID ? 'selected' : ''} value="${section.Sections_ID}">${section.Sections_Name}</option>`
                        );
                    });
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        fetchYear($('.school_edit').val());

        $('.school_edit').on('change', function () {
            fetchYear($(this).val());
        })

        $('.year_edit').on('change', function () {
            fetchSection($(this).val());
        })
    })






    $('.item_filter').on('click', function () {
        const fetchYear = (id) => {
            $.ajax({
                url: `actions/manage_student.php`,
                type: 'GET',
                data: {
                    getYear: true,
                    Schools_ID: id
                },
                success: function (response) {
                    console.log('Response:', response);
                    let dataDiv = $('.year');
                    const years = response.data;
                    dataDiv.empty();
                    years.forEach(year => {
                        dataDiv.append(
                            `<option value="${year.Year_ID}">${year.Year}</option>`
                        );
                    });

                    // Call fetchSection here after the year data is loaded
                    fetchSection($('.year').val());
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        const fetchSection = (id) => {
            $.ajax({
                url: `actions/manage_student.php`,
                type: 'GET',
                data: {
                    getSection: true,
                    Year_ID: id
                },
                success: function (response) {
                    console.log('Response:', response);
                    let dataDiv = $('.section');
                    const sections = response.data;
                    dataDiv.empty();
                    sections.forEach(section => {
                        dataDiv.append(
                            `<option value="${section.Sections_ID}">${section.Sections_Name}</option>`
                        );
                    });
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        }

        fetchYear($('.school').val());

        $('.school').on('change', function () {
            fetchYear($(this).val());
        })

        $('.year').on('change', function () {
            fetchSection($(this).val());
        })
    })

})
