var filename = ""
$('#classes').on('change', () => {
    console.log("mySidebar")
    var acad = $("#acad").val()
    var classes = $('#classes').val()
    if (acad === "--") {
        console.log("none")
        $('.data').html('');
    } else {
        console.log(acad);
        $.ajax({
            type: 'post',
            url: 'adminajax.php',
            data: "getempty=" + true + '&acad=' + acad + "&classes=" + classes,
            success: function (data) {
                $('.data').html(data);
                // console.log(data);
                $('#water').show();

                var num = $("#count").val();
                console.log(num);
                $('#num').html(num + " Empty Rooms At Specific Time.")
            },
            error: function () {
                console.log(response.status);
            },
        })
        filename = acad + "_emptyslots";
    }
})


function get_professors() {
    var department = $('#department').val()
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "department=" + department,
        success: function (data) {
            $('#professor').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

function get_professor_time() {
    var prof = $('#professor').val()
    console.log(prof)
    console.log($('#year').val())
    $.ajax({
        type: 'post',
        url: 'adminajax.php',
        data: "ad69420=" + prof + '&acadyear=' + $('#year').val(),
        success: function (data) {
            $('.data').html(data);
        },
        error: function () {
            console.log(response.status);
        },
    })
}

var button = document.getElementById("button");
var makepdf = document.getElementById("data");

button.addEventListener("click", function () {
    window.print();
});