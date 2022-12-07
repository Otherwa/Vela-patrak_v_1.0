$('#get_empty').on('click', () => {
    console.log("mySidebar")
    var acad = $("#acad").val()
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
})