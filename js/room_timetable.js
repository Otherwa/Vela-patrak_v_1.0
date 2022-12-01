// get data timetable from
function get_data_timetable(data) {
    console.log(data);
    let academic_year = $("#academic_year").val();
    let class1 = $("#class").val();
    let room = data;
    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "class202=" + class1 + "&ad6=" + academic_year + "&room=" + room,
        success: function (data) {
            $('#load_data').html(data);

        },
        error: function () {
            console.log(response.status);
        },
    })

}


function clear_prev() {
    $('#room').val('--');
    $('#day').val('--');
}

function clear_prev1() {
    $('#day').val('--');
}