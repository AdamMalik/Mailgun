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
    @if ($error == 'true')
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
        User sudah terdaftar !
      </div>
    @elseif($error == 'false')
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        User berhasil ditambah !
      </div>
    @endif
      
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
              <th>Password</th>
              <th style="text-align:center; width:200px ">Action</th>
            </tr>
            @foreach($alluser as $item)
            <tr>
              <td>{{++$idx}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->email}}</td>
              <td>{{$item->password}}</td>
              <td style="text-align:center">
                <a href="#!" data-toggle="modal" data-target="#modal-default" class="edit">
                  <span class="y" style="background-color:#3c8dbc;color:#fff;padding:5px 10px">
                    <i class="fa fa-pencil"></i>
                  </span>
                </a>
                <a href="/delete/{{$item->id}}" onclick="return confirm('Are you sure?')"  class="">
                  <span class="z" style="background-color:#dd4b39;color:#fff;padding:5px 10px">
                    <i class="fa fa-trash"></i>
                  </span>
                  <!-- <i class="fa fa-trash"></i> Delete -->
                </a>
              </td>
            </tr>
            @endforeach
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
        <form class="form-horizontal" action="/edit-user" method="post">
          {{csrf_field()}}
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
                <input type="text" name="password" class="form-control" id="editPassword" placeholder="Password">
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
        <form class="form-horizontal" action="/add-user" method="post">
          {{csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <label for="editEmail" class="col-sm-2 control-label">Email</label>

              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="editEmail" placeholder="Email">
                <!-- <input type="hidden" name="mail" id="edEmail"> -->
              </div>
            </div>
            <div class="form-group">
              <label for="editName" class="col-sm-2 control-label">Nama</label>

              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="editName" placeholder="Nama">
              </div>
            </div>
            <div class="form-group">
              <label for="editPassword" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-10">
                <input type="text" name="password" class="form-control" id="editPassword" placeholder="Password">
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
@endsection