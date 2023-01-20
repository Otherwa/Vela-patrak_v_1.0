var filename = null;

// get data timetable from
function get_total_data(data) {
    console.log(data);
    let academic_year = data;

    console.log(academic_year);
    $.ajax({
        type: 'post',
        url: './admin/adminajax.php',
        data: "ad69=" + academic_year,
        success: function (data) {
            $('#load_data').html(data);
            $('#water').show();
            filename = academic_year + "_Master";
        },
        error: function () {
            console.log(response.status);
        },
    })
}


var button = document.getElementById("button");
var makepdf = document.getElementById("data");

let doc_width = 8.27;  // A4 measures 210 × 297 millimeters or 8.27 × 11.69 inches
let doc_height = 11.69;
let aspect = doc_height / doc_width;
let dpi = 120; // targeting ~1200 window width
let img_width = doc_width * dpi;
let img_height = doc_height * dpi;
let win_width = img_width;
let win_height = img_height;

let jsPDFOpts = {
    orientation: 'portrait',
    unit: 'in',
    format: [doc_width, doc_height]
};


button.addEventListener("click", function () {
    html2pdf().set({
        margin: [0.01, 0.01, 0.01, 0.01],
        jsPDF: jsPDFOpts,
    }).from(makepdf).save(filename);
});
