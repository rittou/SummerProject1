 $(function(){
  $(window).scroll(function(){
    if ($('body').scrollTop() > 650) {
      $('.menu nav.navbar.navbar-fixed-top').addClass('trans1');
      $('.menu .logo a.navbar-brand').addClass('trans2');
      $('.navbar-fixed-bottom .backhome').addClass('trans3');
    }else if ($('body').scrollTop() <= 650) {
      $('.menu nav.navbar.navbar-fixed-top').removeClass('trans1');
      $('.menu .logo a.navbar-brand').removeClass('trans2');
      $('.navbar-fixed-bottom .backhome').removeClass('trans3');
    }
  });

    $('.navbar-fixed-bottom .backhome').click(function(){
      window.scrollTo(0,0);
    });

    $('.cometocontact').click(function(){
      window.scrollTo(0,4500);
    });

  $(document).ready(function(){
      $('#changePassword').change(function(){
        if ($(this).is(':checked')) {
          $('.password').removeAttr('disabled');
        }else {
          $('.password').attr('disabled','');
        }
      });
    });

    $(document).ready(function(){
        $('#changeAddress').change(function(){
          if ($(this).is(':checked')) {
            $('.address').removeAttr('disabled');
          }else {
            $('.address').attr('disabled','');
          }
        });
      });

    // $(document).ready(function(){
    //   $('.btnSend').click(function(){
    //     window.scrollTo(0,2500);
    //   });
    // });


  $(document).ready(function(){
    $('.updateCart').click(function(){
      var rowId = $(this).attr('id');
      var qty = $(this).parent().parent().parent().parent().find('#qty').val();
      var token = $("input[name='_token']").val();
      $.ajax({
        url: 'updateCart/' + rowId + '/' + qty,
        type: 'GET',
        cache: false,
        data: {'_token':token,'id':rowId,'qty':qty} ,
        success: function(data){
              window.location ='cart';
        }
      });
    });
  });

  $(document).ready(function(){
    $('.removefromCart').click(function(){
      var rowId = $(this).attr('id');
      var token = $("input[name='_token']").val();
      $.ajax({
        url: 'removefromCart/' + rowId,
        type: 'GET',
        cache: false,
        data: {"_token":token,"id":rowId} ,
        success: function(data){
              window.location ='cart';
        }
      });
    });
  });

  $(document).ready(function(){
    $('.orderCancel').click(function(){
      var id = $(this).attr('id');
      var token = $("input[name='_token']").val();
      $.ajax({
        url: 'orderCancel/' + id,
        type: 'GET',
        cache: false,
        data: {"_token":token,"id":id} ,
        success: function(data){
              window.location ='orderList';
        }
      });
    });
  });
  // $(document).ready(function(){
  //   $('.anotherAddress').click(function(){
  //     $('.anotherAddress').addClass('border');
  //   });
  // });
});
