// get data timetable from
function get_total_data(data) {
    console.log(data);
    let academic_year = $('#academic_year1').val();
    let department = data;
    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "ad619=" + academic_year + "&dep=" + department,
        success: function (data) {
            $('#load_data').html(data);
            $('#water').show();

        },
        error: function () {
            console.log(response.status);
        },
    })
}