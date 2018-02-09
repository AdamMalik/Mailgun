@extends('template.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @if(explode('/',Route::current()->uri)[0] == 'search-draft')
        Draftbox
        @elseif(explode('/',Route::current()->uri)[0] == 'search-mail')
        Mailbox
        @else
        Sentbox
        @endif
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        @if(explode('/',Route::current()->uri)[0] == 'search-draft')
        <li class="active">Draftbox</li>
        @elseif(explode('/',Route::current()->uri)[0] == 'search-mail')
        <li class="active">Mailbox</li>
        @else
        <li class="active">Sentbox</li>
        @endif
        <li class="active">Search</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
              @if(explode('/',Route::current()->uri)[0] == 'search-draft')
              Draftbox
              @elseif(explode('/',Route::current()->uri)[0] == 'search-mail')
              Mailbox
              @else
              Sentbox
              @endif
              </h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  @if(explode('/',Route::current()->uri)[0] == 'search-draft')
                  <form action="/search-draft">
                  @elseif(explode('/',Route::current()->uri)[0] == 'search-mail')
                  <form action="/search-mail">
                  @else
                  <form action="/search-sent">
                  @endif
                    <input type="text" name="search" class="form-control input-sm" value="{{$cari}}" placeholder="Search Mail">
                    <input type="submit" hidden>
                    {{csrf_field()}}
                  </form>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <thead>
                    <th>#</th>
                    <th>&nbsp;</th>
                    @if(explode('/',Route::current()->uri)[0] == 'search-draft')
                    <th>to</th>
                    @elseif(explode('/',Route::current()->uri)[0] == 'search-mail')
                    <th>from</th>
                    @else
                    <th>to</th>
                    @endif
                    <th>subject</th>
                  </thead>
                  <tbody>
                  @foreach($allmess as $item)
                    @if(explode('/',Route::current()->uri)[0] == 'search-mail')
                      @if($item->read == 0)
                      <tr style="font-weight:bolder">
                      @else
                      <tr>
                      @endif
                    @else
                    <tr>
                    @endif
                    <!-- <tr> -->
                      <td style="width:10px">{{++$idx}}</td>
                      <td class="mailbox-star">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      @if(explode('/',Route::current()->uri)[0] == 'search-draft')
                      <td class="mailbox-name"><a href="/read-mail/{{$item->id}}">{{$item->to_user}}</a></td>
                      @elseif(explode('/',Route::current()->uri)[0] == 'search-mail')
                      <td class="mailbox-name"><a href="/read-mail/{{$item->id}}">{{$item->from_user}}</a></td>
                      @else
                      <td class="mailbox-name"><a href="/read-mail/{{$item->id}}">{{$item->to_user}}</a></td>
                      @endif
                      <td class="mailbox-subject">{{$item->subject}}</td>
                      <td class="mailbox-attachment">
                        @if(explode('/',Route::current()->uri)[0] == 'search-mail')
                          @if($item->read == 0)
                          unread
                          @else
                          <span style="font-style:italic">read</span>
                          @endif
                        @endif
                      </td>
                      <td class="mailbox-date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="/search-mail/{{$cari}}/1">&laquo;</a></li>
                    @for($i=0;$i<$pages;$i++)
                      @if($start == $i)
                      <li><a style="background-color:#ddd !important; cursor:not-allowed" href="/search-mail/{{$cari}}/{{$i+1}}">{{$i+1}}</a></li>
                      @else
                      <li><a href="/search-mail/{{$cari}}/{{$i+1}}">{{$i+1}}</a></li>
                      @endif
                    @endfor
                    <li><a href="/search-mail/{{$cari}}/{{$pages}}">&raquo;</a></li>
                  </ul>
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection