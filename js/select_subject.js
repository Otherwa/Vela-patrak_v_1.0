console.log("select subject");

function get_classes() {

    let profname = $('#ProfessorName').val();
    console.log(profname);

    // clear the current list
    $('#Class').html('<option value=\"--\">--</option>');
    $('#Subject').html('<option value=\"--\">--</option>');

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'prof=' + profname,
        success: function (data) {
            $('#Class').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

function get_subject() {
    let class1 = $('#Class').val();
    let sem = $('#Semester').val();
    // clear the current list
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class1=' + class1 + '&sem=' + sem,
        success: function (data) {
            $('#Subject').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}