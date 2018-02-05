@extends('template.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <!-- <small>13 new messages</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="/compose" method="post">
              <div class="form-group">
                <input class="form-control" name="to" placeholder="To:" id="to" value="{{$pesan[0]->to_user}}">
              </div>
              <div class="form-group">
                <input class="form-control" name="subject" placeholder="Subject:" id="subject" value="{{$pesan[0]->subject}}">
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default">Clear</button>
            </div>
            <!-- /.box-footer -->
          </div>
          </form>
          <!-- /. box -->
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection