$(".checkbox-toggle").click(function () {
    var clicks = $(this).data('clicks');
    if (clicks) {
      //Uncheck all checkboxes
      $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
      $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    } else {
      //Check all checkboxes
      $(".mailbox-messages input[type='checkbox']").iCheck("check");
      $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    }
    $(this).data("clicks", !clicks);
    var check = $("input:checked");
    console.log(check.length)
    if(check.length > 0){
      $("#trash").removeAttr("disabled");
      $("#readed").removeAttr("disabled");
    } else {
      $("#trash").attr('disabled','disabled');
      $("#readed").attr('disabled','disabled');
    }
  });
    
  $( "input[type=checkbox]" ).on( "click", function(){
    var check = $("input:checked");
    console.log(check.length)
    if(check.length > 0){
      $("#trash").removeAttr("disabled");
      $("#readed").removeAttr("disabled");
    } else {
      $("#trash").attr('disabled','disabled');
      $("#readed").attr('disabled','disabled');
    }
  });


  $('#trash').click(function(event) {
    var data = $("input:checked");
    var sent = [];
    // console.log(data[0].value)
    for(i=0;i<data.length;i++){
      sent.push(data[i].value)
    }

    $.ajax({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/del',
      type: 'POST',
      dataType: 'json',
      data: {arrayId : sent},
      success: function (data) {
          if(data.success){
            // terkirim = true;
            // console.log(data.id);
            location.reload();
          }
      },
      async : false
    });
  });


  $('#readed').click(function(event) {
    var data = $("input:checked");
    var sent = [];
    // console.log(data[0].value)
    for(i=0;i<data.length;i++){
      sent.push(data[i].value)
    }

    $.ajax({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: '/del',
      type: 'POST',
      dataType: 'json',
      data: {arrayId : sent},
      success: function (data) {
          if(data.success){
            // terkirim = true;
            // console.log(data.id);
            location.reload();
          }
      },
      async : false
    });
  });