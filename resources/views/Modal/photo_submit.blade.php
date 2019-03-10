<div class="modal fade" id="photo_submit_dlg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered zoomIn  animated" role="document">
        <div class="modal-content" style="
    width: 100%;
    height: 650px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLongTitle">Select the photo you want to use FLIP</h4>

            </div>
            <div class="modal-body">

                <div class="" style="margin: auto;background: lightgray;margin-bottom: 20px;padding: 10px">
                 

                </div>
                <div class="col-sm-12 row " style=" text-align: center;width:100%;height:370px;margin: auto;">

                    <div class="col-sm-12 ">

                        {{-----------------------------------------------}}
                        click here or drag here your images for preview and set userprofile_picture data

                        {{-----------------------------------------------}}
                        <div class="uploader_submit" onclick="$('#filePhoto_submit').click()">
                            <img id="imagepreview_submit" src=""/>
                            <input type="file" name="userprofile_picture"  id="filePhoto_submit" />
                        </div>
                        {{-----------------------------------------------}}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="photo_submit" class="btn_submit" >Submit</button>
            </div>
        </div>
    </div>
</div>
<style>
    {{----}}
.uploader_submit {position:relative; overflow:hidden; width:100%; height:100%; background:#f3f3f3; border:2px dashed #e8e8e8;}

    #filePhoto_submit{
        position: absolute;
        width:100%;
        height:100%;
        top:-50px;
        left:0;
        z-index:2;
        opacity:0;
        cursor:pointer;
    }

    #photo_submit_dlg .uploader_submit img{

        width:auto;
        height:400px;
        top:-1px;
        left:-1px;
        z-index:1;
        border:none;
    }
    {{----}}



    #photo_submit_dlg .modal-dialog {
        max-width: 900px!important;
        margin: 1.75rem auto;
    }
    #photo_submit_dlg .modal-body {
        width: 100%!important;
    }
    #photo_submit_dlg .container {
        position: relative;
        width: 50%;
    }

    #photo_submit_dlg .image {
        display: block;
        width: 100%;
        height: auto;
    }




</style>
<script>

</script>