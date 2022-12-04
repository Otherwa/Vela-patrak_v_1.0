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
    let class2 = $('#class').val();
    // clear the current list
    $('#room').val('--');
    $('#division').val('--');

    $('#subjects').html('<option value=\"--\">--</option>');
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class4=' + class1 + "&cal=" + class2,
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
        $('.styled-table td div').css('pointer-events', 'all');
        // console.log(1212 + "adfsf");
    } else {
        $('td div').css('pointer-events', 'none');
        // console.log(1212);
    }

    if ($('#semester2').val() != '--' && $('#class2').val() != '--' && $('#academic_year2').val() != '--') {
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

    modal.fadeIn();
    $('#day').html(day1);
    $('#time').html(time[time1]);

    $('#subjects').val('--');

});

// close
var span = $(".close");
span.on('click', function () {

    modal.fadeOut();
    $('#subject').val('--');
    $('#division').val('--');
    $('#room').val('--');
    $('#subjects').val('--');
    $('#semester').val('--');
    $('#combined').prop('checked', false);
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

var checked;
$('#combined').click(function () {
    if ($(this).is(':checked')) {
        checked = true;
        get_sub5();
    } else {
        checked = false;
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

    console.log(checked);
    // timming data

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "time=" + real_timming + "&day=" + day + "&acad=" + academic + "&room=" + room + "&div=" + div + "&part=" + part + "&sem=" + sem + "&class9=" + class2 + "&mem=" + member + '&sub=' + subject + "&checked=" + checked, //string input
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
            checked = false;
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
        $("#class1").val("--");
        $("#semester1").val("--");
        $('#academic_year1').val("--");
        $('#divison14').val("--");

        $("#timetable").show();
        $('#timetable1').hide();
        $('#inpt-form').show();
        $('#timetable2').hide();
    }
    else if (data === "delete") {
        $("#class2").val("--");
        $("#semester2").val("--");
        $('#academic_year2').val("--");
        $('#divison15').val("--");
        $("#timetable").hide();
        $('#timetable1').hide();
        $('#timetable2').show();
        $('#inpt-form').hide();
        $('#load_data2').html("");
    } else if (data === "load") {
        $('#load_data').html("");
        $('#timetable1 .form__div #class').val('--');
        $("#timetable").hide();
        $("#timetable2").hide();
        $('#timetable1').show();
        $('#inpt-form').hide();
    }

})

function clear_prev() {
    $("#class1").val('--')
    $('#semester1').val('--');
    $('#divison14').val('--');
}

function clear_pre2() {
    $("#class2").val('--')
    $('#semester2').val('--');
    $('#divison15').val('--');
}

function clear_pre1() {
    $('#divison14').val('--');
}
// filter to load data from
function get_sem1(data) {
    $('#divison14').val('--');
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

// filter to load data from
function get_sem2(data) {
    $('#divison15').val('--');
    let class1 = data;
    // clear the current list

    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'class5=' + class1,
        success: function (data) {
            $('#semester2').html(data);
            // console.log(data);

        },
        error: function () {
            console.log(response.status);
        },
    })
}

function delete_data(id) {
    var academic_year2 = $("#academic_year2").val();
    var class1 = $("#class2").val();
    var sem = $("#semester2").val();
    var div = $("#divison15").val();
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: 'Idto=' + id + '&acad=' + academic_year2 + '&class1=' + class1 + '&sem=' + sem + '&div=' + div,
        success: function (data) {
            console.log(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

function get_data_timetable2(data) {
    console.log(data + "@");
    var class101 = $("#class2").val();
    var sem = $("#semester2").val();
    var academic_year = $('#academic_year2').val();
    var div = data
    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "class303=" + class101 + "&sem2=" + sem + "&ad2=" + academic_year + "&div2=" + div,
        success: function (data) {
            $('#load_data2').html(data);
            $("#load_data2 tr td p").click((event) => {

                var id = event.target.id;
                console.log(this)
                $(event.target).css("color", "red");
                let text = "Are You Sure You want to delete ?";
                if (confirm(text) == true) {
                    console.log(true);
                    // ajax to delete
                    console.log(id);
                    delete_data(id);

                } else {
                    console.log(false)
                }
            });
        },
        error: function () {
            console.log(response.status);
        },
    })
}



var filename;

// get data timetable from
function get_data_timetable(data) {
    console.log(data);
    var class101 = $("#class1").val();
    var sem = $("#semester1").val();
    var academic_year = $('#academic_year1').val();
    var div = data
    console.log(academic_year);
    if (data != '--') {
        $.ajax({
            type: 'post',
            url: 'adminajax.php',
            data: "class101=" + class101 + "&sem1=" + sem + "&ad1=" + academic_year + "&div=" + div,
            success: function (data) {
                $('#load_data').html(data);

            },
            error: function () {
                console.log(response.status);
            },
        })
    } else {
        $('#load_data').html('');
    }
    filename = academic_year + "_" + class101 + "_" + sem + "_" + div;
}

// download pdf



var button = document.getElementById("button");
var makepdf = document.getElementById("styled-table");

button.addEventListener("click", function () {
    html2pdf().from(makepdf).save(filename);
});


