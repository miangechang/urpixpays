<style>
            /*@media only screen and (max-width: 376px) {*/
            /*    #flip_logo{*/
            /*        height:50%;*/
            /*        width:100%;*/
                   /*display:none;*/
                   /*overflow: scroll;*/
            /*      }*/
            /*    }*/
        </style>
<div class="modal fade" id="flip_dlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="
    width: 1200px;
    height: 600px!important;">
            <div class="modal-header" style="padding-bottom: 0px!important;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row" style="margin: 0;">
                    <ul class="nav nav-tabs  col-sm-4"  style="border-bottom:none" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" data-toggle="tab" href="#home">Flip</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " data-toggle="tab" href="#menu1">Charge</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Wand</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-body row">


                    <!-- Nav tabs -->


                    <!-- Tab panes -->
                    <div class="tab-content" style="margin:auto;">
                        <div id="home" class=" container tab-pane active" style="height: 80%;"><br>
                            <div CLASS="row" style="margin: auto;margin-top: 20px;">
                            <div class="col-sm-5" id = "flip_logo"style="text-align: center;background-color: #218ccc;width:50%;height: 80%;border-radius: 15px; background-image:url('{{asset('/img/logo003.png')}}'); background-size:cover;width:300px;">
                                
                                <h4 style="color: white"></h4>
                                <p style="color: white"></p>

                            </div>
                            <div class="col-sm-7 " style="text-align: center;width:70%;height: 80%; padding-top:0px;padding-right: 0px;margin-right: 0px">
                                <div class="col-sm-12 row" style="text-align: center;width:100%;padding-left:10px;height: 48%; margin-bottom:15px;padding-right: 0px">
                                    <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                        <div class="col-sm-12 swap_buy_type" >
                                        <img style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_0.png">
                                            <h5 ng-bind="pack.description">1 Flips</h5>
                                            <BUTTON onclick="buy_flip_fill(1,1)" class="gs-btn--blue" style = "background-color:#ff6600;">$0.49</BUTTON>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                        <div class="col-sm-12 swap_buy_type" >
                                         <img style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_0.png">
                                            <h5 ng-bind="pack.description">5 Flips</h5>
                                            <BUTTON onclick="buy_flip_fill(1,1)" class="gs-btn--blue" style = "background-color:#ff6600;">$1.99</BUTTON>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-6"  style="padding-bottom: 0px!important;">-->
                                    <!--    <div class="col-sm-12 swap_buy_type" >-->
                                    <!--    <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/PHOTO_SWAP_1.png">-->
                                    <!--         <h5 ng-bind="pack.description">5 Flips</h5>-->
                                    <!--        <BUTTON onclick="buy_flip_fill(1,1)" class="gs-btn--blue" style = "background-color:#ff6600;">$1.99</BUTTON> -->
                                    <!--    </div>-->
                                    <!--</div -->
                                </div>
                                <div class="col-sm-12 row" style="text-align: center;width:100%;padding-left:10px;height: 48%;padding-right: 0px ">
                                     <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                        <div class="col-sm-12 swap_buy_type" >
                                        <img style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_0.png">
                                            <h5 ng-bind="pack.description">10 Flips</h5>
                                            <BUTTON onclick="buy_flip_fill(1,10)" class="gs-btn--blue" style = "background-color:#ff6600;">$3.49</BUTTON> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                        <div class="col-sm-12 swap_buy_type" >
                                         <img style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_0.png">
                                            <h5 ng-bind="pack.description">25 Flips</h5>
                                            <BUTTON onclick="buy_flip_fill(1,25)" class="gs-btn--blue" style = "background-color:#ff6600;">$7.5</BUTTON> 
                                        </div>
                                    </div> 
                                </div>

                            </div>
                        </div>
                        </div>
                        <div id="menu1" class="container tab-pane fade"  style="height: 80%;"><br>
                            <div CLASS="row" style="margin: auto;margin-top: 20px;">
                                <div class="col-sm-5" style="text-align: center;background-color: #218ccc;width:50%;height: 80%;border-radius: 15px; background-image:url('{{asset('/img/logo001.png')}}'); background-size:cover;width:300px;">
                                    <!--<img  style="width: 100%;height: 60%" src="{{asset('/img/logo001.png')}}">-->
                                    <h4 style="color: white"></h4>
                                    <p style="color: white"></p>

                                </div>
                                <div class="col-sm-7 " style="text-align: center;width:70%;height: 80%; padding-top:0px;padding-right: 0px;margin-right: 0px">
                                    <div class="col-sm-12 row " style="text-align: center;width:100%;padding-left:10px;height: 48%; margin-bottom:15px;padding-right: 0px">
                                        <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_0.png">
                                                <h5 ng-bind="pack.description">1 Charges</h5>
                                                <BUTTON onclick="buy_flip_fill(2,1)" class="gs-btn--blue" style = "background-color:#ff6600;">$0.49</BUTTON>

                                            </div>
                                        </div>
                                        <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_1.png">
                                                <h5 ng-bind="pack.description">5 Charges</h5>
                                                <BUTTON onclick="buy_flip_fill(2,5)" class="gs-btn--blue" style = "background-color:#ff6600;">$1.99</BUTTON>
                                            </div>
                                        </div>
 
                                    </div>
                                    <div class="col-sm-12 row" style="text-align: center;width:100%;padding-left:10px;height: 48%;padding-right: 0px ">
                                         <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_2.png">
                                                <h5 ng-bind="pack.description">10 Charges</h5>
                                                <BUTTON onclick="buy_flip_fill(2,10)" class="gs-btn--blue" style = "background-color:#ff6600;">$3.49</BUTTON>

                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/EXPOSURE_AUTOFILL_3.png">
                                                <h5 ng-bind="pack.description">25 Charges</h5>
                                                <BUTTON onclick="buy_flip_fill(2,25)" class="gs-btn--blue" style = "background-color:#ff6600;">$7.5</BUTTON>

                                            </div>
                                        </div>
                                         
                                         


                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="menu2" class="container tab-pane fade" style="height: 80%;"><br>
                            <div CLASS="row" style="margin: auto;margin-top: 20px;">
                                <div class="col-sm-5" style="text-align: center;background-color: #218ccc;width:50%;height: 80%;border-radius: 15px; background-image:url('{{asset('/img/logo002.png')}}'); background-size:cover;width:360px;margin-left:-30px;">
                                    <!--<img  style="width: 100%;height: 60%" src="{{asset('/img/logo002.png')}}">-->
                                    <h4 style="color: white"></h4>
                                    <p style="color: white"></p>

                                </div>
                                <div class="col-sm-7 " style="text-align: center;width:70%;height: 80%; padding-top:0px;padding-right: 0px;margin-right: 0px">
                                    <div class="col-sm-12 row " style="text-align: center;width:100%;padding-left:10px;height: 48%; margin-bottom:15px;padding-right: 0px">
                                        <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/PHOTO_SWAP_0.png">
                                                <h5 ng-bind="pack.description">1 Wands</h5>
                                                <BUTTON onclick="buy_flip_fill(3,1)" class="gs-btn--blue" style = "background-color:#ff6600;">$0.59</BUTTON>

                                            </div>
                                        </div>
                                        <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/PHOTO_SWAP_1.png">
                                                <h5 ng-bind="pack.description">5 Wands</h5>
                                                <BUTTON onclick="buy_flip_fill(3,5)" class="gs-btn--blue" style = "background-color:#ff6600;">$2.75</BUTTON>
                                            </div>
                                        </div>
                                      


                                    </div>
                                    <div class="col-sm-12 row" style="text-align: center;width:100%;padding-left:10px;height: 48%;padding-right: 0px ">
                                        
                                          <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/PHOTO_SWAP_2.png">
                                                <h5 ng-bind="pack.description">10 Wands</h5>
                                                <BUTTON onclick="buy_flip_fill(3,10)" class="gs-btn--blue" style = "background-color:#ff6600;">$5</BUTTON>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6"  style="padding-bottom: 0px!important;">
                                            <div class="col-sm-12 swap_buy_type" >
                                                <img  style="width: 100%;height: 50%;    " src="https://web.gurushots.com/assets/images/gsApp/modals/shop/PHOTO_SWAP_3.png">
                                                <h5 ng-bind="pack.description">25 Wands</h5>
                                                <BUTTON onclick="buy_flip_fill(3,25)" class="gs-btn--blue" style = "background-color:#ff6600;">$11.25</BUTTON>

                                            </div>
                                        </div>
                                       
                                       


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>






            </div>

        </div>
    </div>
</div>
<style>
    .col-sm-4{
        padding: 5px!important;
    }
    .swap_buy_type {
        background-color: #e6e6e6!important;
        border-radius: 5px;
        margin-bottom: 0px!important;
        padding-bottom: 20px!important;
        padding-top: 10px;
    }
    .gs-btn--blue, .gs-btn--red, .gs-btn--grey, .gs-btn--instagram {
        display: inline-block;
        min-width: 90px;
        margin: 0;
        padding: 5px;
        cursor: pointer;
        text-align: center;
        vertical-align: middle;
        text-decoration: none;
        color: #fff;
        border: none;
        border-radius: 5px;
        background-color: #218ccc;
        font-size: 14px;
        font-weight: 600;
        line-height: 1;
    }
    .nav-tabs .nav-link {
         border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }
    .modal-dialog {
        max-width: 900px!important;
        margin: 1.75rem auto;
    }
    .modal-body {

        margin: 0!important;
        padding: 0 !important;
    }
    .container {
        position: relative;
        width: 50%;
    }

    .image {
        display: block;
        width: 100%;
        height: auto;
    }

    .overlay {
        position: absolute;
        top: 40px;
        bottom: 0;
        left: 55px;
        right: 0;
        height: 100px;
        width: 100px;
        opacity: 0;
        transition: .7s ease;
        background-color:white;
        border-radius: 100%;
        outline: none!important;
    }

    .container:hover .overlay {
        opacity: 0.8;
    }

    .text {
        color: black;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .gs-btn--blue{
        background-color:#ff6600;
        background-color:#ff6600;
    }
</style>
<script>


</script>