var filename = ""
$('#get_empty').on('click', () => {
    console.log("mySidebar")
    var acad = $("#acad").val()
    if (acad === "--") {
        console.log("none")
    } else {
        console.log(acad);
        $.ajax({
            type: 'post',
            url: 'adminajax.php',
            data: "getempty=" + true + '&acad=' + acad,
            success: function (data) {
                $('.data').html(data);
                // console.log(data);

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


var button = document.getElementById("button");
var makepdf = document.getElementById("data");

button.addEventListener("click", function () {
    html2pdf().from(makepdf).save(filename);
});