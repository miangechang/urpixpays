@include ('Modal/alert_message_dlg')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal animate fade" id="signindlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle">SIGN IN</h5>

            </div>
            <div class="modal-body">
                <div >

                    <div class="form-group">
                        <label for="inputEmail3">Email</label>
                        <input id="email1" type="email" name="email" class="form-control"  placeholder="email@gmail.com" required="">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3">Password</label>
                        <input id="password1" type="password" name="password" class="form-control"  placeholder="password" title="At least 6 characters with letters and numbers" required="">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit_btn1" class="btn_submit" >Log in</button>


                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
<style>
    .modal-content{
        width:350px;
    }
    .modal-title{
        text-align: center;
    }
    .modal-header{
        display: block!important;
    }
    .modal-header h5{
        color: black;
    }
    .modal-body h4{
        color: black;

    }
    .modal-body{
        width: 350px;
    }
    .btn_submit{
        margin-top: 25px;
        width: 320px;
        height: 40px;
        border-radius: 10px;
        background-color:#F29620;
        border:0;
    }

    .inputfield{
        width: 100%;
        border-width: 0;
        border-bottom: 1px solid black;
    }
    input[type=text]:focus, input[type=password]:focus {
        background-color: #fff;
        outline: none;
    }
    form{
        padding-right: 50px;
        padding-left: 50px;
    }
</style>
<script>
    var input = document.getElementById("password1");
    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("submit_btn1").click();
      }
    });
    
</script>
<script>
    $('#submit_btn1').click(function(){

        var email = $('#email1').val();
        var password = $('#password1').val();
        if(!email || !password) {
            alert("Input your information correctly");
            return;
        }
        //alert(" correctly");
        var request = $.ajax({
            url: '{{url('login1')}}',
            type: 'post',
            data: { email:email,password:password} ,

            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                console.log(response);
                var obj = JSON.parse(response);
                //alert('correctly');
                // alert(obj.message);
                $('#alertmessage').attr('value', obj.message);
                $('#signindlg').modal('toggle');
                
                
                $('#alert_message_dlg').attr('class', 'modal fade animate');
                $('#alert_message_dlg').modal('show');
                setTimeout(function() {
                    $('#alert_message_dlg').attr('class', 'modal fade animateout');
                    $('#alert_message_dlg').modal('toggle');
                    console.log(obj);
                    setCookie('email',email,60);
                    // setCookie(email,obj.data,60);
                    setCookie('id',obj['data']['no'],60);
                    window.location.replace('{{url('challenges/my')}}');
                }, 1000);
                
                
                // console.log(obj);
                // setCookie('email',email,60);
                // // setCookie(email,obj.data,60);
                // setCookie('id',obj['data']['no'],60);
                // window.location.replace('{{url('challenges/my')}}');

            },
            error: function(response){

                console.log(response);
                alert('error');

            }
        });

        request.done(function(data) {
            // your success code here
        });

        request.fail(function(jqXHR, textStatus) {
            // your failure code here
        });
    });
    function setCookie(cname,cvalue,exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toGMTString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

</script>
