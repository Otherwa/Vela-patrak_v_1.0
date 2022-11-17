// get data timetable from
function get_data_timetable(data) {
    console.log(data);
    let academic_year = $("#academic_year").val();
    let class1 = $("#class").val();
    let room = $("#room").val();
    let day = data;
    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "class202=" + class1 + "&ad6=" + academic_year + "&day=" + day + "&room=" + room,
        success: function (data) {
            $('#load_data').html(data);

        },
        error: function () {
            console.log(response.status);
        },
    })

}