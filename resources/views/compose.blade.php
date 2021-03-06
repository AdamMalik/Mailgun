@extends('template.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Compose
        <!-- <small>13 new messages</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Compose</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="myerror">
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
              @if(explode('/',Route::current()->uri)[0] != 'read-draft')
              <form action="/draft" method="post" class="pull-right" id="draft">
                {{csrf_field()}}
                <input type="hidden" name="to" id="drTo">
                <input type="hidden" name="subject" id="drSubject">
                <input type="hidden" name="mail" id="drMail">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-file"></i>
                  draft
                </button>
              </form>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(explode('/',Route::current()->uri)[0] == 'read-draft')
              <form action="/compose" id="compose" method="post">
                <div class="form-group">
                  <input class="form-control" name="to" placeholder="To:" id="to" value="{{$pesan[0]->to_user}}">
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" placeholder="Subject:" id="subject" value="{{$pesan[0]->subject}}">
                  <input class="form-control" name="id" type="hidden" value="{{$pesan[0]->id}}">
                </div>
                <div class="form-group">
                      <textarea id="compose-textarea" name="mail" class="form-control" style="height: 300px">
                        {{$pesan[0]->message}}
                      </textarea>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <!-- <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary" id="send" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Sending your messagae"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <a href="/delete-draft/{{$pesan[0]->id}}" onclick="return confirm('Are you sure?')" class="btn btn-default"><i class="fa fa-trash"></i> Delete Draft</a>
                <button type="reset" class="btn btn-default">Clear</button>
              </div>
              <!-- /.box-footer -->
            </div>
            </form>
            @else
              <form action="/compose" id="compose" method="post">
                <div class="form-group">
                  @if($email != null)
                  <input class="form-control" value="{{$email}}" name="to" placeholder="To:" id="to">
                  @else
                  <input class="form-control" name="to" placeholder="To:" id="to">
                  @endif
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" placeholder="Subject:" id="subject">
                  <input class="form-control" name="id" type="hidden">
                </div>
                <div class="form-group">
                      <textarea id="compose-textarea" name="mail" class="form-control" style="height: 300px"></textarea>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <!-- <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary" id="send" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Sending your messagae"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default">Clear</button>
              </div>
              <!-- /.box-footer -->
            </div>
            </form>
            
            @endif
          <!-- /. box -->
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script>
  var terkirim = false;
  $(document).on('submit','#compose', function(event) {
    // return false;
    event.preventDefault();
    var data = $("#compose").serialize();
    console.log(data);
    // return false;
    // $('#send').on('click', function() {
    var $this = $('#send');
    $this.button('loading');
    var loader = setTimeout(function() {
        $this.button('reset');
    },20000);
    // });
    $.ajax({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/compose',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function (data) {
          console.log(data.success, loader);
          clearTimeout(loader,0);
          $this.button('reset');
          $this.html('send');
          console.log(data.success, loader);
          if(data.success){
            terkirim = true;
            toastr.success('Pesan berhasil dikirim')
          } else {
            toastr.error('Pesan gagal dikirim !')
          }

          $('#compose-textarea').val('')
          $('#to').val('')
          $('#subject').val('')
          console.log(data.success, loader);
          // $('#password-confirmed').val('')
      }
    })
    return false;
  })

  $('#draft').submit(function(event) {
    $('#drSubject').val($('#subject').val());
    $('#drTo').val($('#to').val());
    $('#drMail').val($('#compose-textarea').val());  
    // console.log($('#drMail').val())
    return true;
  });
  
  @if(explode('/',Route::current()->uri)[0] != 'read-draft')
    $(window).on('beforeunload',function() {
      var data = $("#compose").serialize();
      if(!terkirim && ($('#subject').val() != "" || $('#to').val() != "" || $('#compose-textarea').val() != "") ){
        $.ajax({
          headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: '/draft',
          type: 'POST',
          dataType: 'json',
          data: data,
          success: function (data) {
              if(data.success){
                terkirim = true;
                toastr.success('Pesan berhasil dikirim')
              } else {
                toastr.error('Pesan gagal dikirim !')
              }
          },
          async : false
        });
      }
    });
  @endif
  
  </script>
@endsection