
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="modal fade " id="submit_continue_dlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered bounceIn  animated"  role="document" >
        <div class="modal-content" style="border-width: 0px; background-color: rgba(255,255,255,0);margin-left: auto;margin-right: auto" >
            <div class="modal-header "  style="border-width: 0px; padding-bottom:5px;text-align:center;background-color: rgba(255,255,255,0);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: cyan; outline: 0px;">

                    <span aria-hidden="true" style="display:none;">&times;</span>
                </button>
            <!--{{--<h5 class="modal-title" id="exampleModalLongTitle">SIGN IN</h5>--}}-->
                <img class="" src="https://web.gurushots.com/assets/images/gsApp/modals/lets_go.png"  height="100" width="70%" alt="backgrounppp" title="backgrounppp" style="padding-left:10px" >


            </div>
            <div class="modal-body" style="border-radius: 10px; background-color: rgba(255,255,255,1);">
                <div >

                    <div class="form-group">
                        <h5 class="modal-title" id="join_challenge_title" style="color: #2ca8ff"></h5>

                        <h6 id="join_challenge_description">

                        </h6>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6" style="text-align: center">
                            <button id="challenges_submit_photo_continue" class="btn_submit " style="color:white " >CONTINUE</button>
                        </div>
                        <div class="col-sm-6" style="text-align: center">
                            <button id="challenges_submit_view_rules" class="btn_submit "  style="color:white ">VIEW RULES</button>
                        </div>
                    </div>
                    <div id='challenge_id' style="display: none"></div>
                    

                </div>
            </div>

        </div>
    </div>
</div>
<style>

    #submit_continue_dlg .modal-content{
        width:350px;
    }
    #submit_continue_dlg .modal-title{
        text-align: center;
    }
    #submit_continue_dlg .modal-header{
        display: block!important;
    }
    #submit_continue_dlg .modal-header h5{
        color: black;
    }
    #submit_continue_dlg .modal-body h4{
        color: black;

    }
    #submit_continue_dlg .modal-body{
        width: 350px;
        padding:20px!important;
    }
    #submit_continue_dlg .btn_submit{

        margin-top: 25px;
        width: 130px!important;
        height: 30px!important;
        padding-right: 10px!important;
        padding-left: 10px!important;
        border-radius: 5px!important;
        background-color:#218ccc!important;
        border:0;
    }
    #submit_continue_dlg form .row{}
    #submit_continue_dlg .inputfield{
        width: 100%;
        border-width: 0;
        border-bottom: 1px solid #218ccc;
    }
    #submit_continue_dlg input[type=text]:focus, input[type=password]:focus {
        background-color: #fff;
        outline: none;
    }
    #submit_continue_dlg form{
        padding-right: 50px;
        padding-left: 50px;
    }
    #submit_continue_dlg .modal-content{
        padding:0!important;
    }
</style>
<script>


</script>
