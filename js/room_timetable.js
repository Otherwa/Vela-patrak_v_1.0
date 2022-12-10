var filename;

// get data timetable from
function get_data_timetable(data) {
    console.log(data);
    let academic_year = $("#academic_year").val();
    let class1 = $("#class").val();
    let room = $("#room").val();
    let sem = data;
    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "class202=" + class1 + "&ad6=" + academic_year + "&room=" + room + "&sem=" + sem,
        success: function (data) {
            $('#load_data').html(data);
            $('#water').show();

        },
        error: function () {
            console.log(response.status);
        },
    })
    filename = academic_year + "_" + room + "_" + sem;
}


var button = document.getElementById("button");
var makepdf = document.getElementById("styled-table");

button.addEventListener("click", function () {
    html2pdf().from(makepdf).save(filename);
});


function clear_prev() {
    $('#room').val('--');
    $('#day').val('--');
}

function clear_prev1() {
    $('#day').val('--');
}