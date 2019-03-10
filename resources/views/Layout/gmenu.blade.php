@include ('Modal/signup')
@include ('Modal/signin')
@include ('Modal/Verify')
<!--@include ('Modal/alert_message_dlg')-->

<style>
    body {
        min-height: 75rem;
        padding-top: 4.5rem;
    }
    .navbar{
        background-color: #333;
    }
    #navbarCollapse{
        position: relative;
    }
    #rightbutton{
        width: 100%;
        position:absolute;
        right: 0%;
        padding-left: 450px;
    }
    #rightbutton a{
        margin-right: 10px;
        background-color: #f92;
        border-radius: 8px;
        width: 150px;
        height: 45px;
        text-align: center;
        padding-top: 8px;
        margin-top: 5px;

    }
    #rightbutton a span{
        padding-right: 10px;
        font-size: 20px;
        font-family: "aktiv-grotesk-std",sans-serif;

    }
    #rightbutton a img{
        height:  25px;
        margin-bottom: 7px;
    }
    .navbar-nav .nav-item .nav-link{
        font-size: 18px;
        padding-right: 30px;

    }
    #rightbutton::before{
        content: '';
        width: calc(100% - 330px);
        height: 6px;
        background-color:  #f92;
        /*border-radius: 5px;*/
    }
    #navbarCollapse .nav-item{
        z-index: 10;
    }
    .modal-content{
        margin:auto!important;
    }

</style>


<nav class="navbar navbar-expand-md navbar-dark fixed-top ">
    <a class="navbar-brand" href="#"><img src={{asset("img/logo.jpg")}}   /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto" style="width: 500px;">
            <!--<li class="nav-item active" >-->
            <!--    <a class="nav-link" href="#">Challenges <span class="sr-only">(current)</span></a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="#">Activity</a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link" href="#">Discover</a>-->
            <!--</li>-->
            <!--<li id="last" class="nav-item">-->
            <!--    <a class="nav-link" href="#">Articles</a>-->
            <!--</li>-->
            <div id="rightbutton" class="form-inline mt-2 mt-md-0" >
                <a id="first" href='signin' data-toggle="modal" data-target="#signindlg"><span>SIGN IN</span><img src={{asset("img/signin.png")}}/></a>
                <a href='#' data-toggle="modal" data-target="#signupdlg"><span>SIGN UP</span><img src={{asset("img/signup.png")}}/></a>
            </div>
        </ul>


    </div>


</nav>

<script>
    
</script>
