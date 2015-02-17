$(document).ready(function() {
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