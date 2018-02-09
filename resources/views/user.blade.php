@extends('template.layout')

@section('content')
<div class="content-wrapper">
  <!-- <div class="row"> -->
    <section class="content-header">
      <h1>
        User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">User</li>
      </ol>
    </section>
    <section class="content">
      <div class="myerror">
      </div>
    <!-- <div class="col-sm-12" style="margin-top:20px"> -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">User Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div style="margin-bottom:10px">
            <a href="/add-user" style="width:calc(300px / 2)" data-toggle="modal" data-target="#modal-add" class="btn btn-primary"><i class="fa fa-plus"></i> Add new user</a>
          </div>
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">#</th>
              <th>Nama</th>
              <th>Email</th>
              <th style="text-align:center; width:200px ">Action</th>
            </tr>
            <tbody id="usertable">
              @foreach($alluser as $item)
              <tr>
                <td>{{++$idx}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td style="text-align:center">
                  <a href="#!" data-toggle="modal" data-target="#modal-default" class="edit">
                    <span class="y" style="background-color:#3c8dbc;color:#fff;padding:5px 10px">
                      <i class="fa fa-pencil"></i>
                    </span>
                  </a>
                  <a href="/delete/{{$item->id}}"  class="deleteuser">
                    <span class="z" style="background-color:#dd4b39;color:#fff;padding:5px 10px">
                      <i class="fa fa-trash"></i>
                    </span>
                    <!-- <i class="fa fa-trash"></i> Delete -->
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="/user/1">&laquo;</a></li>
            @for($i=0;$i<$pages;$i++)
              @if($start == $i)
              <li><a style="background-color:#ddd !important; cursor:not-allowed" href="/user/{{$i+1}}">{{$i+1}}</a></li>
              @else
              <li><a href="/user/{{$i+1}}">{{$i+1}}</a></li>
              @endif
            @endfor
            <li><a href="/user/{{$pages}}">&raquo;</a></li>
          </ul>
        </div>
      </div>
    <!-- </div> -->
    </section>
  <!-- </div> -->
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Default Modal</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="/edit-user" id="edituser" method="post">
          <!-- {{csrf_field()}} -->
          <div class="box-body">
            <div class="form-group">
              <label for="editEmail" class="col-sm-2 control-label">Email</label>

              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="editEmail" disabled placeholder="Email">
                <input type="hidden" name="mail" id="edEmail">
              </div>
            </div>
            <div class="form-group">
              <label for="editName" class="col-sm-2 control-label">Nama</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" disabled id="editName" placeholder="Nama">
                <input type="hidden" name="name" id="editNam">
              </div>
            </div>
            <div class="form-group">
              <label for="editPassword" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-10">
                <input type="password" required minlength="6" name="password" class="form-control" id="editPassword" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label for="password-confirmed" class="col-sm-2 control-label">Confirm Password</label>

              <div class="col-sm-10">
                <input type="password" minlength="6" required name="password_confirmation" class="form-control" id="password-confirmed" placeholder="Password">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Edit</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add user</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="/add-user" method="post" id="adduser">
          <div class="box-body">
            <div class="form-group">
              <label for="addEmail" class="col-sm-2 control-label">Email</label>

              <div class="col-sm-10">
                <input type="email" name="email" required class="form-control" id="addEmail" placeholder="Email">
                <!-- <input type="hidden" name="mail" id="edEmail"> -->
              </div>
            </div>
            <div class="form-group">
              <label for="addName" class="col-sm-2 control-label">Nama</label>

              <div class="col-sm-10">
                <input type="text" name="name" required class="form-control" id="addName" placeholder="Nama">
              </div>
            </div>
            <div class="form-group">
              <label for="addPassword" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-10">
                <input minlength="6" required type="password" name="password" class="form-control" id="addPassword" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label for="password-confirm" class="col-sm-2 control-label">Confirm Password</label>

              <div class="col-sm-10">
                <input minlength="6" required type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Password">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Add</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  $(document).ready(function() {
    $('#adduser').submit(function(event) {
    event.preventDefault();
    var data = $("#adduser").serialize();
    // console.log(data);
    // return false;
    $.ajax({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/add-user',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function (data) {
          if(!data.success){
            toastr.error('User sudah terdaftar !')
            $('#modal-add').modal('toggle');
          } else {
            toastr.success('User berhasil ditamabah')
            $('#modal-add').modal('toggle');
            $('#usertable').append(`
              <tr>
                <td>`+data.total+`</td>
                <td>`+$('#addName').val()+`</td>
                <td>`+$('#addEmail').val()+`</td>
                <td style="text-align:center">
                  <a href="#!" data-toggle="modal" data-target="#modal-default" class="edit">
                    <span class="y" style="background-color:#3c8dbc;color:#fff;padding:5px 10px">
                      <i class="fa fa-pencil"></i>
                    </span>
                  </a>
                  <a href="/delete/`+data.id+`" onclick="return confirm('Are you sure?')"  class="deleteuser">
                    <span class="z" style="background-color:#dd4b39;color:#fff;padding:5px 10px">
                      <i class="fa fa-trash"></i>
                    </span>
                    <!-- <i class="fa fa-trash"></i> Delete -->
                  </a>
                </td>
              </tr>              
            `)
          }
          $('#addEmail').val('')
          $('#addName').val('')
          $('#addPassword').val('')
          $('#password-confirm').val('')
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        if(XMLHttpRequest.status == 422){
          toastr.error('Password anda tidak sesuai !')
          $('#modal-add').modal('toggle');
        }
      }
    })
    return false;
  })

  $(document).on('submit','#edituser', function(event) {
    // return false;
    event.preventDefault();
    var data = $("#edituser").serialize();
    console.log(data);  
    // return false;
    $.ajax({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/edit-user',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function (data) {
          console.log(data.success);
          if(data.success){
            toastr['success']('Password berhasil diubah');
            // console.log(toastr)
            $('#modal-default').modal('toggle');
          } else {
            toastr['error']('Anda tidak melakukan perubahan password !')
            $('#modal-default').modal('toggle');
          }

          $('#editEmail').val('')
          $('#editName').val('')
          $('#editPassword').val('')
          $('#password-confirmed').val('')
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
        if(XMLHttpRequest.status == 422){
          toastr.error('Password anda tidak sesuai !')
          console.log(toastr)
          $('#editPassword').val('')
          $('#password-confirmed').val('')
          $('#modal-default').modal('toggle');
        }
      }
    })
    return false;
  })
  $(document).on('click','.deleteuser',function(event) {
    // return false;
    event.preventDefault();
    var confirms = confirm('Are you sure?')
    // var data = $("#edituser").serialize();
    var tujuan = ($(this).attr('href')).toString();
    var data = tujuan.split('/');
    console.log('didit')
    var tr = $(this).parent().parent();
    // console.log(confirms)
    if(confirms){
      $.ajax({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },
        url: tujuan,
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if(data.success){
              tr.remove();
              toastr.success('Berhasil menghapus user !')
            }
        }
      })
    }
    // return false;
  })
  });

    // .done(function() {
    //   console.log("success");
    // })
    // .fail(function() {
    //   console.log("error");
    // })
    // .always(function() {
    //   console.log("complete");
    // });
    
    // $('#drSubject').val($('#subject').val());
    // $('#drTo').val($('#to').val());
    // $('#drMail').val($('#compose-textarea').val());  
    // // console.log($('#drMail').val())
    // return true;
</script>
@endsection