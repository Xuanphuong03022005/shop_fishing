$('#search-value').keyup(function(){
    var data =$(this).val();
    
        $.ajax({
            url: '?controller=homecontroller&action=loadAllProducts',
            type: 'GET',
            data :{
                search_data : data
            }
        })
        .done(function(result){
            console.log(result)
            $('#product-list').empty();
            if(result != ''){
                $('#product-list').append(result)
            }else if( result == ''){
                $('#product-list').append(
                                            "<div class='alert alert-warning' role='alert'>\n\
                                        A simple warning alert—check it out!\n\
                                    </div>"
                                        );
            }
        })
        .fail(function() {
    
        });
   
})
// Khi người dùng nhấn nút "Load More Products"
    // $('#search-value').keyup(function() {
    //     var search_data = $(this).val();
    //     if (search_data.length >2 || search_data.length == 0) {
    //         $.ajax({
    //             url: '?controller=homecontroller&action=loadAllProducts', // Đường dẫn đến controller và action
    //             type: 'GET', // Hoặc 'POST' nếu cần thiết
    //             timeout: 10000,
    //             data: {
    //                 search_data: search_data
    //             },
    //             success: function(response) {
    //                 $('#product-list').empty();
    //                 // Append HTML trả về từ controller vào phần tử có id="product-list"
    //                 if (response != '') {
    //                     $('#product-list').append(response);
    //                 } else {
    //                     $('#product-list').append(
    //                         "<div class='alert alert-warning' role='alert'>\n\
    //                     A simple warning alert—check it out!\n\
    //                 </div>"
    //                     );
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 console.log("Error: " + error); // Xử lý lỗi nếu có
    //             }
    //         });
    //     }

    // });
