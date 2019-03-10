
<html>
<head>
    @include('Layout/head')
</head>
<body>
<header>
    @include('Layout.gmenu')
</header>
<div class="container-fuild">
    <section>
        <div class="contentcenter paddingtop-50 backgroundimage ">
            <h3>Submit your pictures and win CASH.</h3>
            <h5>You will love taking photos like never before!</h5>
             <a href='#' data-toggle="modal" data-target="#signupdlg">
                <img class="vc_single_image-img " src="http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/clickme-200x200.png" width="200" height="200" alt="clickme" title="clickme">
            </a>
            <h5>As we say “Turn your Pictures into Cash”</h5>

        </div>
        <div class="contentcenter paddingtop-50">
            <h2>This is custom heading element<br>
                No need to be a professional photographer</h2>
        </div>
        <div class="row paddingtop-50">
            <div class="col-md-6 contentcenter backgroundimage_left">
                <img class="vc_single_image-img " src="http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/00001-300x300.png" width="300" height="300" alt="00001" title="00001">
            </div>
            <div class="col-md-6 contentcenter backgroundimage_right" >
                <img class="vc_single_image-img " src="http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/00022222-300x300.png" width="300" height="300" alt="00022222" title="00022222">
            </div>

        </div>
        <div class="contentcenter paddingtop-50">
            <h2>Show your tales to the world</h2>
        </div>



        <div class="contentcenter paddingtop-50 backgroundimage_bottom col-md-12">
            <div class="vc_custom_1539283329338">
                <div class="">
                    <div class="">

                        <figure class="">
                            <div class="">
                                <img class="" src="http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/backgrounppp-47x54.png" width="47" height="54" alt="backgrounppp" title="backgrounppp"></div>
                        </figure>
                    </div>
                    <h2 style="font-size: 20px;color: #020202;line-height: 25px;text-align: center" class="vc_custom_heading vc_custom_1539283407375">Show Your Talent<br>
                    </h2>
                    <div class="">
                        <div class="">
                            <p style="text-align: center;">Show your photography talent to</p>
                            <p style="text-align: center;">the world.</p>
                            <p style="text-align: center;">Get votes, receive comments and</p>
                            <p style="text-align: center;">likes on your pictures.</p>

                        </div>
                    </div>
                </div></div>

        </div>

    </section>
</div>
<footer class="bg-dark">
    @include('Layout/footer')
</footer>
</body>
</html>
<style>
    .vc_single_image-img{
        margin-top: 10px;
        margin-bottom: 30px;
    }
    .backgroundimage h3,h5{
        color: white;
        line-height: 35px;

    }

    section{
        min-height: 500px;

    }
    .contentcenter{
        text-align: center
    }
    .paddingtop-50{
        padding-top: 50px;
    }
    .backgroundimage{
        padding-top: 150px;
        background-image: url(http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/homepic.jpg?id=33) !important;
        height:577px;
    }
    .backgroundimage_left{

        background-image: url(http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/bganother.png?id=39) !important;

    }
    .backgroundimage_right{

        background-image: url(http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/bgtoanother.png?id=40) !important;

    }

    .backgroundimage_bottom{
        height: 484px;


        background-image: url(http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/talents.jpg?id=47) !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;

    }
    .vc_custom_1539283329338 {
        background-image: url(http://ajronitesting.com/PixPays/wp-content/uploads/2018/10/talents.png) !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        height: 500px;
        width: 400px;
        background-size: 300px 400px !important;
        right: 0%;
        line-height: 10px;
        position: absolute;
        padding-top: 200px;
    }

   </style>
