function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let tr = $(this);
    Swal.fire({
        title: 'Bạn Có Chắc Chắn Xóa?',
        text: "Bạn Sẽ Không Thể Hoàn Tác Sau Hành Động Này",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng Ý'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlRequest,
                type: 'get',
                success: function(data){
                    if(data.code == 200){
                        tr.parent().parent().remove();
                        Swal.fire(
                            'Đã Xóa!',
                            'Tệp Của Bạn Đã Bị Xóa.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Không Thể Xóa!',
                            'Tệp Của Bạn Chưa Được Xóa.',
                            'error'
                        );
                    }
                }
            });
        }
    })
}
function actionRestore(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let tr = $(this);
    Swal.fire({
        title: 'Bạn Có Chắc Chắn Khôi Phục?',
        text: "Bạn Sẽ Không Thể Hoàn Tác Sau Hành Động Này",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng Ý'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlRequest,
                type: 'GET',
                success: function(data){
                    if(data.code == 200){
                        tr.parent().parent().remove();
                        Swal.fire(
                            'Đã Khôi Phục!',
                            'Tệp Của Bạn Đã Được Khôi Phục.',
                            'success'
                        );
                    } else {
                        // tr.parent().parent().remove();
                        Swal.fire(
                            'Không Thể Khôi Phục!',
                            'Tệp Của Bạn Chưa Được Khôi Phục.',
                            'error'
                        );
                    }
                }
            });
        }
    })
}
// function addToCart(event){
//     event.preventDefault();
//     let urlRequest = $(this).data('url');
//     let tr = $(this);
//     Swal.fire({
//         title: 'Bạn Có Chắc Chắn Cập Nhật?',
//         text: "Bạn Sẽ Không Thể Hoàn Tác Sau Hành Động Này",
//         icon: 'question',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Đồng Ý'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: urlRequest,
//                 type: 'PUT',
//                 success: function(data){
//                     if(data.code == 200){
//                         tr.parent().parent().remove();
//                         Swal.fire(
//                             'Đã Cập Nhật!',
//                             'Tệp Của Bạn Đã Được Cập Nhật.',
//                             'success'
//                         );
//                     } else {
//                         // tr.parent().parent().remove();
//                         Swal.fire(
//                             'Không Thể Cập Nhật!',
//                             'Tệp Của Bạn Chưa Được Cập Nhật.',
//                             'error'
//                         );
//                     }
//                 }
//             });
//         }
//     })
// }
// $(function () {
//     $(document).on('click', '.addToCart', addToCart);
// });
$(function () {
    $(document).on('click', '.ajax_delete', actionDelete);
});
$(function () {
    $(document).on('click', '.ajax_restore', actionRestore);
});