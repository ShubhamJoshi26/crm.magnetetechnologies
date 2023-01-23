function EditPermission(id)
{
 if(id!='')
 {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:'permission',
        data:{id:id,_token:CSRF_TOKEN},
        type:'post',
        success:function(suc)
        {
            // console.log(suc);
            $('#permission_modal').modal('show');
            $('#permission_table').html(suc);
        }
    })
 }
}