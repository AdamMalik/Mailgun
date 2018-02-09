@extends('template.layout')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Read Mail
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      @if(explode('/',Route::current()->uri)[0] == 'read-mail')
      <li class="active">Inbox</li>
      @else
      <li class="active">Sentbox</li>
      @endif
      <li class="active">Read</li> 
    </ol>
  </section>
  <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Read Mail</h3> -->

              <div class="box-tools pull-right">
                @if(explode('/',Route::current()->uri)[0] == 'read-mail')
                  @if($pesan[0]->id != $next)
                  <a href="/read-mail/{{$next}}" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-left"></i></a>
                  @endif
                  @if($pesan[0]->id != $previous)
                  <a href="/read-mail/{{$previous}}" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-right"></i></a>
                  @endif
                @else
                  @if($pesan[0]->id != $next)
                  <a href="/read-sent/{{$next}}" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-left"></i></a>
                  @endif
                  @if($pesan[0]->id != $previous)
                  <a href="/read-sent/{{$previous}}" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-right"></i></a>
                  @endif
                @endif
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>{{$pesan[0]->subject}}</h3>
                <h5>From : {{$pesan[0]->from_user}}</h5>
                <h5>To : {{$pesan[0]->to_user}}</h5>
                  <!-- <span class="mailbox-read-time pull-right">15 Feb. 2016 11:03 PM</span></h5> -->
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <!-- /.btn-group -->
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                {!! $pesan[0]->message !!}
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <a href="/compose/{{$pesan[0]->from_user}}" class="btn btn-default"><i class="fa fa-reply"></i> Reply</a>
                <a href="/forward/{{$pesan[0]->id}}" class="btn btn-default"><i class="fa fa-share"></i> Forward</a>
              </div>
              @if(explode('/',Route::current()->uri)[0] == 'read-sent')
              <a href="/delete-sent/{{$pesan[0]->id}}" onclick="return confirm('Are you sure?')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a>
              @else
              <a href="/delete-message/{{$pesan[0]->id}}" onclick="return confirm('Are you sure?')" class="btn btn-default"><i class="fa fa-trash"></i> Delete</a>
              @endif
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
@endsection