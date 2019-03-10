<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal animate fade" id="signupdlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLongTitle">SIGN UP</h5>

            </div>
            <div class="modal-body">
                <div >
                        @csrf
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="full name">
                    </div>
                    <div class="form-group">
                        <label for="inputVerify3">Mobile Number</label>
                        <input type="text" class="form-control" name ="mobile_number"  id="mobile_number" placeholder="Enter Phone Number" required="">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="email@gmail.com" required="">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password" title="At least 6 characters with letters and numbers" required="">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit_btn" class="btn_submit" >Register</button>
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
    form .row{}
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
    var name;
    var mobile_number;
    var email ;
    var password ;
    var vc;
    var login=function(){
        var request=$.ajax({
            url: '{{url('register1')}}',
            type: 'post',
            data: { vc: vc, email:email} ,

            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                console.log(obj);
                var obj = JSON.parse(response);
                alert(obj.message);
                switch (obj.state) {
                    case 1:
                        $('#verifydlg').modal('toggle');
                        //$('#verifydlg').modal('show');
                        break;
                    default:
                        break;
                }
                console.log(response);
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
    };


    var sendvc=function(){
        var request=$.ajax({
            url: '{{url('sendvc')}}',
            type: 'post',
            data: { name: name, mobile_number : mobile_number ,email:email,password:password} ,

            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){

                console.log(obj);
                var obj = JSON.parse(response);
                // alert(obj.message);
                // switch (obj.state) {
                //     case 1:
                        $('#signupdlg').modal('toggle');
                        // $('#verifydlg').modal('show');
                        $('#alertmessage').attr('value', "Success");
                        // $('#signindlg').modal('toggle');
                        $('#alert_message_dlg').attr('class', 'modal fade animate');
                        $('#alert_message_dlg').modal('show');
                        setTimeout(function() {
                            $('#alert_message_dlg').attr('class', 'modal fade animateout');
                            $('#alert_message_dlg').modal('toggle');
                        }, 1000);
                //         break;
                //     default:
                //         break;

                // }

                console.log(response);


            },
            error: function(response){

                // console.log(response);
                // alert('error');
                $('#signupdlg').modal('toggle');
                // $('#verifydlg').modal('show');
                $('#alertmessage').attr('value', "Error123");
                // $('#signindlg').modal('toggle');
                $('#alert_message_dlg').attr('class', 'modal fade animate');
                $('#alert_message_dlg').modal('show');
                setTimeout(function() {
                    $('#alert_message_dlg').attr('class', 'modal fade animateout');
                    $('#alert_message_dlg').modal('toggle');
                }, 1500);
            }
        });

        request.done(function(data) {
            // your success code here
        });

        request.fail(function(jqXHR, textStatus) {
            // your failure code here
        });
    };
    $('#submit_btn').click(function(){
        name = $('#name').val();
        mobile_number = $('#mobile_number').val();
        email = $('#email').val();
        password =$('#password').val();
        if(!name || !mobile_number || !email || !password) {
            alert("Input your information correctly");
            return;
        }
        sendvc();
        //$('#signupdlg').modal('toggle');
        //$('#verifydlg').modal('show');
    });

</script>