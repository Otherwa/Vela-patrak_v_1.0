function get_subjects() {
    let department = $('#SubList').val();
    console.log(department);
    // clear the current list
    $('#_list').html('');
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'subject=' + department,
        success: function (data) {
            $('#_list').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}