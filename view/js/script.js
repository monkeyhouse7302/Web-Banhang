$(document).ready(function () {
    $('#sortOption').change(function () {
        $('form').submit();
    });
    
    $('#price_bot, #price_top').on('input', function () {
        var value = $(this).val().replace(/,/g, '');
        value = Number(value).toLocaleString('en-US');
        $(this).val(value);
    });
});

$(document).ready(function() {
    $("#getLocation").click(function() {
        // Kiểm tra xem trình duyệt có hỗ trợ định vị không
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, handleError);
        } else {
            alert("Trình duyệt của bạn không hỗ trợ định vị.");
        }
    });

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Gọi API để lấy địa chỉ từ tọa độ
        var reverseGeocodingApiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;

        // Gửi yêu cầu AJAX để lấy địa chỉ
        $.ajax({
            url: reverseGeocodingApiUrl,
            method: "GET",
            success: function(response) {
                // Lấy địa chỉ từ dữ liệu phản hồi
                var address = response.display_name;

                // Đặt giá trị địa chỉ vào ô input
                $("#address_customer_cart").val(address);
            },
            error: function() {
                alert("Đã có lỗi xảy ra khi lấy địa chỉ.");
            }
        });
    }

    function handleError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Người dùng từ chối cung cấp vị trí.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Không thể xác định được vị trí.");
                break;
            case error.TIMEOUT:
                alert("Yêu cầu lấy vị trí đã quá thời gian.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Đã có lỗi xảy ra khi lấy vị trí.");
                break;
        }
    }
});