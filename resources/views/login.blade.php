<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
	  <!-- iCheck -->
	  <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/flat/blue.css')}}">
	  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
	</head>
	<body style="background-color:#ddd">
		<div class="row">
			
			@if ($msg != 'null')
			<div class="col-sm-6 col-sm-push-3" style="margin-top:20px">
	      <div class="alert alert-danger alert-dismissible">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
	        {{$msg}}
	      </div>
		  </div>
	    @endif
		</div>
	  <div class="row" style="margin-top:20px">
	  	
		<div class="col-sm-4 col-sm-push-4" style="background-color:#fff;">
			<h2>INGOmail</h2>
			<form class="form-horizontal" action="/login" method="post">
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
              <label for="editPassword" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="editPassword" placeholder="Password">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer" style="text-align:center">
            <button type="submit" class="btn btn-block btn-info pull-center">Login</button>
          </div>
          <!-- /.box-footer -->
        </form>
		</div>
	  </div>
	</body>
</html>