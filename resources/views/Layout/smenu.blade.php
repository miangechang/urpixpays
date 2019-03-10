@include ('Modal/signup')
@include ('Modal/signin')
@include ('Modal/Verify')


<style>
    body {
        min-height: 75rem;
        padding-top: 12rem;
    }
    .navbar{
        background-color: #333;
    }
    #navbarCollapse{
        position: relative;
    }


    .navbar-nav .nav-item .nav-link{
        font-size: 18px;
        padding-right: 30px;

    }

    #navbarCollapse .nav-item{
        z-index: 10;
    }
    /*search*/
    #rightbutton .custom_search{
        background-color: #f92;
    }
    #rightbutton button{
        background-color: #f92;
        font-size: 20px;
    }

</style>


<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
    <a class="navbar-brand" href="{{url('challenges/my')}}"><img src={{asset("img/logo.jpg")}}   /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto" style="width: 500px;">
            <li class="nav-item active" >
                <a class="nav-link" href="{{url('challenges/my')}}">Challenges <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Buy/Sale</a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Explore</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/invite')}}">Invite Friends</a>
            </li>


        </ul>
        <div id="rightbutton" class="form-inline mt-2 mt-md-0" >
            <div class="input-group">
                <input class="form-control border-secondary py-2 custom_search" type="search" value="" placeholder="Search member">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="nav-item dropdown show" style="margin-left: 10px;color: white;      font-size: 30px;">
                <div class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="color:white">
                    <span><i class="fa fa-bullhorn"></i></span>
                    <span id="notification_count" style="font-size: 15px;width: 20px;height: 20px;  background-color: red;border-radius: 10px;position: absolute;text-align: center;top: 0%;right: 0;">0</span>

                    <div class="ripple-container"></div>
                </div>
                <div id="notification_item" class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownMenuLink">
                    
                </div>

            </div>
            <div class="input-group">
                <input class="form-control border-secondary py-2 custom_search" type="search" value="" placeholder="UPLOAD" style="width: 100px; margin-left: 10px">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><a href = "{{url('/shop')}}">
                        <i class="fa fa-cloud-upload" aria-hidden="true"></a></i>
                    </button>
                </div>
            </div>
            <div class="dropdown dropleft ">
                <button type="button" class="btn btn-primary " data-toggle="dropdown" style="width: 46px; height: 46px;
                        border-radius: 23px;margin-left: 10px; background-image: url('{{asset("img/logo.jpg")}} '); background-repeat: no-repeat;background-size: cover;background-position: center">

                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href={{url('/landing')}}>Home</a> 
                    <a class="dropdown-item" href={{url('/myprofile')}}>Account Setting</a> 
                    <a class="dropdown-item" href={{url('logout')}}>Log Out</a>
                </div>
            </div>

        </div>

    </div>


</nav>
<script>

    $(document).ready(function() {
        setInterval(getnotification, 10000);
        getnotification();
        function getnotification() {
            $.ajax({
                url: '{{url('getNotification')}}',
                type: 'post',
                data: {} ,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response){
                    var obj = JSON.parse(response);
                    //alert(obj.message);
                    //console.log(obj);
                    var note=obj.data;
                    $('#notification_count').text(note.length);
                    if (note.length==0) {
                        $('#notification_count').css('background-color','grey');
                    }
                    else{
                        $('#notification_count').css('background-color','red');
                        $('#notification_item').html('');
                        for (var i=0;i<note.length;i++){
                            //<div class="dropdown-item" >You have 5 new tasks</div>
                            $('#notification_item').append('<div class="dropdown-item" >' +
                                note[i]['msg'] +
                                '<span style="display: none" >' +
                                    i+
                                '</span>' +
                                '</div>');
                        }
                    }
                    $('.dropdown-item').click(function () {
                        var noteid=$(this).children(' span').html();
                        //alert(noteid);
                        $.ajax({
                            url: '{{url('processNotification')}}',
                            type: 'post',
                            data: {note:note[noteid]} ,
                            beforeSend: function (request) {
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function(response){
                                var obj = JSON.parse(response);
                                //alert(obj.message);
                                console.log(obj);
                                var state=obj.state;
                                switch (state) {
                                    case 1:
                                        window.location.replace(obj.data);
                                        break;
                                    case 2:
                                        //window.location.replace(obj.data);
                                        break;
                                    default:
                                        break;
                                }


                            },
                            error: function (response) {
                                console.log(response);
                                // alert('error');
                            }
                        });

                    });
                    //console.log(obj['data']['exposure']);
                    // var count=obj['data']['exposure'];
                    // for (var jj=0;jj<=count;jj++){
                    //     // console.log(jj);
                    //     if((14-jj)<4)
                    //         $('#chart'+obj['data']['cid']+(14-jj)).css('background-color','green');

                    //     else if((14-jj)<9)
                    //         $('#chart'+obj['data']['cid']+(14-jj)).css('background-color','yellow');
                    //     else
                    //         $('#chart'+obj['data']['cid']+(14-jj)).css('background-color','red');
                    // }

                },
                error: function (response) {
                    console.log(response);
                    //alert('error');
                }
            });
        }

    });
</script>

