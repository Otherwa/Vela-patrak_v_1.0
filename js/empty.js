var filename = ""
$('#acad').on('change', () => {
    console.log("mySidebar")
    var acad = $("#acad").val()
    if (acad === "--") {
        console.log("none")
        $('.data').html('');
    } else {
        console.log(acad);
        $.ajax({
            type: 'post',
            url: 'adminajax.php',
            data: "getempty=" + true + '&acad=' + acad,
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


var button = document.getElementById("button");
var makepdf = document.getElementById("data");

button.addEventListener("click", function () {
    html2pdf().set({
        jsPDF: {
            format: 'a3'
        }
    }).from(makepdf).save(filename);
});