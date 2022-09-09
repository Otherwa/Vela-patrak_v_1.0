console.log("professor");

function get_professor() {
    let department = $('#ProfList').val();
    console.log(department);
    // claer the current list
    $('#_list').html('');
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'department=' + department,
        success: function (data) {
            $('#_list').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}