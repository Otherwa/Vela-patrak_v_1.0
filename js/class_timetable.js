console.log("class timetable");

function get_data() {

    let class1 = $('#class').val();
    let academic_year = $('#academic_year').val();
    let semester = $('#semester').val();
    let division = $('#division').val();

    // clear the current list
    $('#timetable').html('');

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class1=' + class1 + '&acad=' + academic_year + '&sem=' + semester + '&div=' + division,
        success: function (data) {
            $('#').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}
