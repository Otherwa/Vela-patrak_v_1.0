console.log("select subject");

function get_professor() {

    let profname = $('#Department').val();
    console.log(profname);

    // clear the current list
    $('#Class').html('<option value=\"--\">--</option>');
    $('#Subject').html('<option value=\"--\">--</option>');

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'dep=' + profname,
        success: function (data) {
            $('#ProfessorName').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}


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

function get_subjectselected() {
    let department = $('#ProfList').val();
    console.log(department);
    // clear the current list
    $('#_list').html('');
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'departmentast111=' + department,
        success: function (data) {
            $('#_list').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}