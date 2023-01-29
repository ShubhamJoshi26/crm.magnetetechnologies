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

function deleteDepartment(id)
{
    if(id!='')
    {
        if(!confirm("Do you want to delete this department ?")) {
            return false;
          }
          else
          {
            $.ajax({
                url:'department/delete?id='+id,
                type:'get',
                success:function(suc)
                {
                    alert(suc);
                    location.href='department';
                }
            })
          }
    }
}