console.log("class timetable");

$('#subjects').html('<option value=\"--\">--</option>');
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

    $('#subjects').html('<option value=\"--\">--</option>');
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class4=' + class1,
        success: function (data) {
            $('#subjects').html(data);
            // console.log(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

// to set division
function set_room() {
    $('#division').val('--');
}


// for subject

$('#save').prop('disabled', true);


// check if alldetails are filled
setInterval(function () {
    if ($('#part').val() != '--' && $('#class').val() != '--' && $('#division').val() != '--' && $('#academic_year').val() != '--' && $('#subjects').val() != '--') {
        $('#save').prop('disabled', false);
    } else {
        $('#save').prop('disabled', true);
    }

    if ($('#part').val() != '--' && $('#class').val() != '--' && $('#academic_year').val() != '--') {
        $('td div').css('pointer-events', 'all');
        // console.log(1212 + "adfsf");
    } else {
        $('td div').css('pointer-events', 'none');
        // console.log(1212);
    }
}, 900)


// modal dialogue
var modal = $('#modalDialog');
var divtoclick = $('td div');
modal.hide();


// temp data for time and day
var day1 = "";
var time1 = "";

divtoclick.on('click', (event) => {
    // time mapped
    time = [];
    for (let i = 0; i < $('#count').val(); i++) {
        time.push($('#time' + i).html());
    }

    var data = event.target.id;
    data = data.split(',');
    day1 = data[0];
    time1 = data[1];
    alert(event.target.id);
    modal.fadeIn();
    $('#day').html(day1);
    $('#time').html(time[time1]);
});

// close
var span = $(".close");
span.on('click', function () {
    modal.fadeOut();
    $('#division4').val('--');
    $('.extra').hide();
});


function get_sub5() {

    // clear the current list
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class990=' + null,
        success: function (data) {
            $('#subjects2').html(data);
            // console.log(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

$('.extra').hide();
// checks if combied lecture
$('#combined').click(function () {
    if ($(this).is(':checked')) {
        $('.extra').show();
        get_sub5();
    } else {
        $('.extra').hide();
    }
});




// sets data
function set_data() {
    // subject data
    real_timming = time1;
    let day = day1;
    let academic = $('#academic_year').val();
    let room = $('#room').val();
    let div = $('#division').val();
    let sem = $('#semester').val();
    let class2 = $('#class').val();
    let part = $('#part').val();
    let member = $('#memberid').val();
    let subject = $('#subjects').val();
    var division4 = $('#division4').val();
    var sub4 = $('#subjects2').val();
    // timming data

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "time=" + real_timming + "&day=" + day + "&acad=" + academic + "&room=" + room + "&div=" + div + "&part=" + part + "&sem=" + sem + "&class9=" + class2 + "&mem=" + member + '&sub=' + subject + "&div4=" + division4 + "&sub4=" + sub4, //string input
        success: function (data) {
            // alert("Success Data Entered");
            $('.msg').html(data);
            // $('#academic_year').val('--');
            // $('#part').val('--');
            // $('#class').val('--');
            $('#semester').val('--');
            $('#room').val('--');
            $('#division').val('--');
            $('#subject').val('--');
            $('#combined').prop('checked', false);
            $('#division4').val('--');
            $('.extra').hide();
            modal.fadeOut();

        },
        error: function () {
            console.log(response.status);
        },
    })
}

// to do
// $('#timetable').hide();
// hide con toolbar
$('#timetable1').hide();
$('#to-do').on('change', () => {
    let data = $('#to-do').val();
    if (data === "insert") {
        $("#timetable").show();
        $('#timetable1').hide();
        $('#inpt-form').show();
    }
    else if (data === "delete") {
        $("#timetable").hide();
        $('#timetable1').hide();
        $('#inpt-form').hide();
    } else if (data === "load") {
        $('#timetable1 .form__div #class').val('--');
        $("#timetable").hide();
        $('#timetable1').show();
        $('#inpt-form').hide();
    }

})

function clear_prev() {
    $("#class1").val('--')
    $('#semester1').val('--');
}

// filter to load data from
function get_sem1(data) {

    let class1 = data;
    // clear the current list

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class5=' + class1,
        success: function (data) {
            $('#semester1').html(data);
            // console.log(data);

        },
        error: function () {
            console.log(response.status);
        },
    })
}


// get data timetable from
function get_data_timetable(data) {
    console.log(data);
    let class101 = $("#class1").val();
    let sem = data;
    let academic_year = $('#academic_year1').val();
    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "class101=" + class101 + "&sem1=" + sem + "&ad1=" + academic_year,
        success: function (data) {
            $('#load_data').html(data);

        },
        error: function () {
            console.log(response.status);
        },
    })

}