console.log("professor");

function get_professor() {
    let department = $('#ProfList').val();
    console.log(department);
    // claer the current list
    $('#prof_list').html('');

    $.ajax({
        type: 'post',
        url: 'admintemp.php',
        data: 'department=' + department,
        success: function (data) {
            $('#prof_list').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}