<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Ingo Login</title>
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
      <link rel="stylesheet" href="{{asset('toast/toastr.css')}}">
      <script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
      <script src="{{asset('toast/toastr.js')}}"></script>
      <script>
        $(document).ready(function() {
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        });
      </script>
    </head>
    <body style="background-color:#ddd">
        <div class="row">
            
            @if ( $errors->has('email') || $errors->has('password') )
            <script>
              toastr.error("{{$errors->has('email') ? $errors->first('email') : $errors->first('password') }}")
            </script>
            @endif
        </div>
        <div class="row" style="margin-top:50px">
          <div class="head col-sm-4 col-sm-push-4" style="background-color:#00acd6; text-align:center; color:#fff; padding:5px 0">
            <span style="font-weight:bolder;font-size:40px">INGO</span> 
            <span style="font-weight:lighter;font-size:40px;color:#f0f0f0">mail </span>
            <i class="fa fa-lock" style="font-size:40px"></i>
          </div>
        </div>
      <div class="row">
        
        <div class="col-sm-4 col-sm-push-4" style="background-color:#fff;">
          <form class="form-horizontal" action="{{ route('login') }}" method="post">
          {{csrf_field()}}
          <div class="box-body" style="padding-top:40px;padding-bottom:40px">
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
          <div class="box-footer" style="text-align:center;">
            <button type="submit" class="btn btn-info pull-center" style="width:100px">Login</button>
          </div>
          <!-- /.box-footer -->
        </form>
        </div>
      </div>
    </body>
</html>