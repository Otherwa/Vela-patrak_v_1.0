console.log("class timetable");

$('.subjects').html('<option value=\"--\">--</option>');
// default

function get_sem() {

    let class1 = $('#class').val();
    // clear the current list
    $('#part').val('--');
    $('#semester').val('--');
    $('#room').val('--');
    $('#division').val('--');

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class5=' + class1,
        success: function (data) {
            $('#semester').html(data);
            // console.log(data);

        },
        error: function () {
            console.log(response.status);
        },
    })
}

$('#semester').prop('disabled', true);
// set sem or not for junior
function if_junior(data) {
    $('#semester').val('--');


    if (data == "Junior" || data == "--") {
        $('#semester').val('--');
        $('#semester').prop('disabled', true);
    } else {
        $('#semester').prop('disabled', false);
    }
}

function get_sub() {

    let class1 = $('#semester').val();
    // clear the current list
    $('#room').val('--');
    $('#division').val('--');

    $('.subjects').html('<option value=\"--\">--</option>');
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class4=' + class1,
        success: function (data) {
            $('.subjects').html(data);
            // console.log(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

function set_room() {
    $('#division').val('--');
}



$('.subjects').prop('disabled', true);
$('#save').prop('disabled', true);
function set_subject(data) {
    if (data != '--') {
        $('.subjects').prop('disabled', false);
    }
}

// check if alldetails are filled
setInterval(function () {
    if ($('#part').val() != '--' && $('#room').val() != '--' && $('#division').val() != '--') {
        $('#save').prop('disabled', false);
    } else {
        $('#save').prop('disabled', true);
    }
}, 900)

// sets data
function set_data() {
    let count = $('#count').val();

    // subject data
    real_timming = [];
    mon = []
    tue = []
    wed = []
    thu = []
    fri = []
    sat = []

    for (let i = 0; i < count; i++) {

        // timming logic
        real_timming.push($('#time' + i).html());
        mon.push($('#mon' + i).val());
        tue.push($('#tue' + i).val());
        wed.push($('#wed' + i).val());
        thu.push($('#thus' + i).val());
        fri.push($('#fri' + i).val());
        sat.push($('#sat' + i).val());
    }

    let academic = $('#academic_year').val();
    let room = $('#room').val();
    let div = $('#division').val();
    let sem = $('#semester').val();
    let class2 = $('#class').val();
    let part = $('#part').val();
    let member = $('#memberid').val();
    // timming data

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "time=" + real_timming + "&mon=" + mon + "&tue=" + tue + "&wed=" + wed + "&thu=" + thu + "&fri=" + fri + "&sat=" + sat + "&acad=" + academic + "&room=" + room + "&div=" + div + "&part=" + part + "&sem=" + sem + "&class9=" + class2 + "&mem=" + member, //string input
        success: function (data) {
            // alert("Success Data Entered");
            $('.msg').html(data);
            $('#academic_year').val('--');
            $('#part').val('--');
            $('#semester').val('--');
            $('#class').val('--');
            $('#room').val('--');
            $('#division').val('--');
            $('.subjects').val('--').prop('disabled', true);
        },
        error: function () {
            console.log(response.status);
        },
    })
}