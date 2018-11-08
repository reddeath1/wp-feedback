(function ($) {
    $(document).ready(function () {

        $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
        });

        $('.ckbox label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
        });

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
        });

        $('#wpforms-form-6296').on('submit',function () {
            return false;
        });

        $('#wpforms-form-6296').attr('autocomplete', 'off');

        console.log(user);

        $('#wpforms-submit-6296').on('click',function () {
           var fn = $('#wpforms-6296-field_0').val(),
                ln = $('#wpforms-6296-field_0-last').val(),
                em = $('#wpforms-6296-field_1').val(),
                pn = $('#wpforms-6296-field_5').val(),
                dpt = $('input[type="radio"]'),
                dpts = '',
                error = false,
                result = '',
                text = $('#wpforms-6296-field_4').val();

            /**
             * get the radios
             */
           for(var x in dpt){

                if(dpt[x].checked){
                    dpts = dpt[x].value;
                }
            }

          if(fn === ''){
                error = true;
            }

            console.log(fn)
          if(ln === ""){
                error = true;
            }
            console.log(ln)
          if( em == ''){
              error = true;
          }

            console.log(em)

          if(pn === ""){
              error = true;
          }
            console.log(pn)

          if(dpts === ""){
              error = true;
          }
            console.log(dpts)

          if(text === "") {
              error = true;
          }
            console.log(text)
          $(this).text("Please wait");

          if(!error){
               error = false;
              $.ajax(
                  {
                      url:user.url+'/includes/Ajax.php',
                      type:'post',
                      data:{'action':'dofeedback',fn:fn,ln:ln,pn:pn,em:em,dp:dpts,fb:text},
                      success:function(re){
                          result = JSON.parse(re);
                          if(result.success){
                              $('#wpforms-form-6296').html(result.success);
                              setTimeout(function () {
                                  window.location.reload(true);
                              },2000)
                          }else{
                              alert(result.error);
                          }
                      }
                  }
              );

          }else{
              $(this).text("Submit");
               var inp = $('#wpforms-form-6296 input');

               for (var x in inp){
                   if(typeof inp[x].style !== 'undefined'){
                       inp[x].style.borderColor = 'brown'
                   }
                   $('#wpforms-6296-field_4').css('border-color:brown');
               }
              alert('All fields are required!');
          }
        });
    });
})(jQuery);
