// const { isNumber } = require("lodash");

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

function deleteDesignation(id)
{
    if(id!='')
    {
        if(!confirm("Do you want to delete this designation ?")) {
            return false;
          }
          else
          {
            $.ajax({
                url:'designation/delete?id='+id,
                type:'get',
                success:function(suc)
                {
                    alert(suc);
                    location.href='designation';
                }
            })
          }
    }
}
function deleteEmployee(id)
{
    if(id!='')
    {
        if(!confirm("Do you want to delete this employee ?")) {
            return false;
          }
          else
          {
            $.ajax({
                url:'employee/delete?id='+id,
                type:'get',
                success:function(suc)
                {
                    alert(suc);
                    location.href='employee';
                }
            })
          }
    }
}
function deleteTicket(id)
{
    if(id!='')
    {
        if(!confirm("Do you want to delete this employee ?")) {
            return false;
          }
          else
          {
            $.ajax({
                url:'ticket/delete?id='+id,
                type:'get',
                success:function(suc)
                {
                    alert(suc);
                    location.href='ticket';
                }
            })
          }
    }
}
function deleteModule(id)
{
    if(id!='')
    {
        if(!confirm("Do you want to delete this module ?")) {
            return false;
          }
          else
          {
            $.ajax({
                url:'module/delete?id='+id,
                type:'get',
                success:function(suc)
                {
                    alert(suc);
                    location.href='module';
                }
            })
          }
    }
}
function getAllNewTickets(type)
{
    $.ajax({
        url: 'ticket/status?action=getTicket&sts='+type,
        type:'get',
        success:function(res)
        {
            $('#tickettable').html(res);
        }
    })
}
function getAllNewTicketsByUser(type)
{
    $.ajax({
        url: '/ticket/status?action=getTicketByUser&sts='+type,
        type:'get',
        success:function(res)
        {
            console.log(res);
            $('#tickettable').html(res);
        }
    })
}
