$(document).ready(function() {
    $('#fileInput').change(function(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#selectedImage')
                    .attr('src', e.target.result)
                    .width(200); // Thay đổi kích thước ảnh nếu cần
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
});