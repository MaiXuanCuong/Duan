function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let tr = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlRequest,
                type: 'GET',
                success: function(data){
                    if(data.code == 200){
                        tr.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                }
            });
        }
    })
}
$(function () {
    $(document).on('click', '.ajax_delete', actionDelete);
});