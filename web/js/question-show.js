$(function() {
    $('select#category').on('change', function(){
        data = {
            categoryId : this.value
        };

        $.ajax({
            type: "POST",
            data:data,
            success: function(res) {


                //console.log(res);


            }
        });
    });
});

function coverUpload(){
    $('#question_file').click();
}

$(function() {
    document.getElementById("question_file").onchange = function() {
        document.getElementById("cover-upload").submit();
    };
});