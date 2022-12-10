// get data timetable from
function get_total_data(data) {
    console.log(data);
    let academic_year = data;

    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: './admin/adminajax.php',
        data: "ad69=" + academic_year,
        success: function (data) {
            $('#load_data').html(data);
            $('#water').show();

        },
        error: function () {
            console.log(response.status);
        },
    })
}