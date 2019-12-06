$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('#changePassword').change(function () {
        if ($(this).is(':checked')) {
            $('.password').removeAttr('disabled');
        } else {
            $('.password').attr('disabled', '');
        }
    })
    //Delete
    $('.delete').click(function (event) {
        event.preventDefault();
        var url = $(this).attr('data-url');
        var _this = $(this);
        if (confirm('Bạn có muốn xóa không?')) {
            $.ajax({
                type: 'delete',
                url: url,
                success: function (response) {
                    // toastr.options.progressBar = true;
                    if (response.success) {
                        toastr.success(response.success, 'Thông báo!', { timeOut: 1000 });
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                        // _this.parent().parent().remove();
                    } else {
                        toastr.error(response.error, 'Thông báo!', { timeOut: 1000 });
                    }
                }
            })
        }
    });
    // $('.delete').click(function(event){
    //     event.preventDefault();
    //     var url = $(this).attr('data-url');
    //     var _this = $(this);
    //     $('#confirmModal').modal('show');
    //     $('#ok_button').click(function () {
    //         $.ajax({
    //             type: 'delete',
    //             url: url,
    //             success: function(response) {
    //                 $('#confirmModal').modal('hide');
    //                 toastr.success(response.success, 'Thông báo', {timeOut: 1000});
    //                 _this.parent().parent().remove();
    //             }
    //         })
    //     });
    // });
    // $(document).on('click', '.delete', function (event) {
    //     event.preventDefault();
    //     var url = $(this).attr('data-url');
    //     var _this = $(this);
    //     $('#confirmModal').modal('show');
    //     $('#ok_button').click(function () {
    //         $.ajax({
    //             type: 'delete',
    //             url: url,
    //             success: function (response) {
    //                 _this.parent().parent().remove();
    //                 toastr.success(response.success, 'Thông báo', { timeOut: 1000 });
    //                 $('#confirmModal').modal('hide');
    //             }
    //         })
    //     });
    // });
    $('.editbinhluan').click(function (e) {
        $('.error').hide();
        let id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: 'thao-luan/binhluan/'+id+'/edit',
            dataType: 'json',
            type: 'get',
            success: function(response){
                $('.content').val(response.content);
            }
        });
        $('.update').click(function(){
            let content = $('.content').val();
            $.ajax({
                url: 'thao-luan/binhluan/'+id,
                data: {
                    content : content,
                },
                dataType: 'json',
                type: 'put',
                success: function(response){
                    if(response.error == true){
                        $('.error').show();
                        $('.error').text(response.message.content[0]);
                    }
                }
            });
        });
        
    })



    $('.idmuc').change(function () {
        let idm = $(this).val();
        //alert(idCate);
        $.ajax({
            url: 'getchuyenmuc',
            data: {
                idm: idm,
            },
            type: 'get',
            dataType: 'json',
            success: function ($data) {
                console.log($data);
                let html = '';
                $.each($data, function ($key, $value) {
                    if ($value['status'] == 1) {
                        html += '<option value=' + $value['id'] + '>';
                        html += $value['name'];
                        html += '</option>';
                    }
                });
                if ($data != "") {
                    $('.idchuyenmuc').html(html);
                } else {
                    $('.idchuyenmuc').html('<option value="">----- Chọn chuyên mục -----</option>');
                }
            }
        });
    });
    $('.idchuyennganh').change(function () {
        let idcn = $(this).val();
        var t = 0;
        //alert(idCate);
        $.ajax({
            url: 'getlop',
            data: {
                idcn: idcn,
            },
            type: 'get',
            dataType: 'json',
            success: function ($data) {
                let html = '';
                $.each($data, function ($key, $value) {
                    html += '<option value=' + $value['id'] + '>';
                    html += $value['name'];
                    html += '</option>';
                });
                if ($data != "") {
                    $('.idlop').html(html);
                } else {
                    $('.idlop').html('<option value="">----- Chọn lớp -----</option>');
                }
            }
        });
    });
});