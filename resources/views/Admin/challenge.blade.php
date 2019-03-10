@extends('Admin.Layout.dashboard')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        select{
            border: 0;
            width: 100%;
        }
        .btn3d {
            transition:all .08s linear;
            position:relative;
            outline:medium none;
            -moz-outline-style:none;
            border:0px;
            margin-right:10px;
            margin-top:15px;
        }
        .btn3d:focus {
            outline:medium none;
            -moz-outline-style:none;
        }
        .btn3d:active {
            top:9px;
        }
        .btn-default {
            box-shadow:0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #adadad, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#fff;
        }
        .btn-primary {
            box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#428bca;
        }
        .btn-success {
            box-shadow:0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#5cb85c;
        }
        .btn-info {
            box-shadow:0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#5bc0de;
        }
        .btn-warning {
            box-shadow:0 0 0 1px #f0ad4e inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #eea236, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#f0ad4e;
        }
        .btn-danger {
            box-shadow:0 0 0 1px #c63702 inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #C24032, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
            background-color:#c63702;
        }

    </style>
    <style>
            @media only screen and (max-width: 991px) {
                  #sidebar{
                   display:none;
                  }
                }
        </style>
@stop
@include ('Admin.Modal.add_challenge')
@section('content')
    <button type="button" class="btn btn-primary btn-lg btn3d" data-toggle="modal" data-target="#exampleModalCenter">New Challenge</button>
    {{--<li ><a href='signin' data-toggle="modal" data-target="#signindlg">Sign in</a></li>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Challenges Table</h4>
                    {{--<p class="card-category"> Here is a subtitle for this table</p>--}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                No
                            </th>
                            <th>
                                Challenge ID
                            </th>                            
                            <th>
                                Title
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Votes
                            </th>
                            <th>
                                Start Time
                            </th>
                            <th>
                                Period
                            </th>

                            <th>
                                Price
                            </th>
                            <!--<th>-->
                            <!--    Prizes-->
                            <!--</th>-->
                            <th style="text-aline:center;" >
                                Photo Counts
                            </th>
                            <!--<th>-->
                            <!--    Photo Count-->
                            <!--</th>-->
                            <th>
                                state
                            </th>

                            </thead>
                            <tbody>
                            @for($i=0;$i<count($data);$i++)
                                @php
                                    $item = json_decode(json_encode($data[$i]), true);
                                @endphp
                                <tr>
                                    <td>
                                        {{$i+1}}
                                    </td>
                                    <td>
                                        {{$item['id']}}
                                    </td>
                                    <td>
                                        {{$item['title']}}
                                    </td>

                                    <td>
                                        {{$item['description']}}
                                    </td>

                                    <td>
                                        {{$item['votes']}}
                                    </td>
                                    <td>
                                        {{$item['create-time']}}

                                    </td>

                                    <td>
                                        {{$item['timeline']}}
                                    </td>
                                    <td>
                                        {{$item['price']}}
                                    </td>
                                    <!--<td>-->
                                    <!--    <button>{{$item['prize']}}</button>-->
                                    <!--</td>-->
                                    <!--<td>-->
                                    <!--    {{$item['photocount']}}-->
                                    <!--</td>-->
                                    <td>
                                        {{--{{$item['image-url']}}--}}
                                        <!--<button>view</button>-->
                                        {{$item['photocount']}}
                                    </td>
                                    <td>
                                        <select id="s{{$i}}" onchange="selectitem('{{$item['id']}}',this,'s'+'{{$i}}')"  class="custom-select" style="
                                                @php
                                            switch ($item['state']){
                                                case '0':
                                                    echo "color:yellow";
                                                    break;
                                                case '1':
                                                    echo "color:blue";
                                                    break;
                                                default:
                                                    echo "color:red";
                                                    break;
                                                                                    }
                                        @endphp">
                                            <option  @php if($item['state']=='new') echo "selected";@endphp value="0">{{$item['state']}}</option>
                                            <option  @php if($item['state']=='start') echo "selected";@endphp value="1">Start</option>
                                            <option  @php if($item['state']=='closed') echo "selected";@endphp value="2">Closed</option>
                                            <option  @php if($item['state']=='completed') echo "selected";@endphp value="3">Completed</option>
                                            <option  @php if($item['state']=='deleted') echo "selected";@endphp value="4">Deleted</option>
                                            <option  @php if($item['state']=='ended') echo "selected";@endphp value="5">Ended</option>
                                        </select>
                                        {{--                                        {{$item['permission']}}--}}
                                    </td>
                                    <td>
                                        <a href ="{{asset('../admin/c_u/'.$item['id'])}}"><button data-modal-trigger="trigger-1" class="trigger fa fa-fire btn btn-outline-success">View</button></a>
                                    </td>
                                    {{--<td class="text-primary">--}}
                                    {{--$36,738--}}
                                    {{--</td>--}}
                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('script')
    <script>
        function selectitem(item, selectObject,id){
            //alert(id);

            //var selectedCountry = $(this).children("option:selected").val();
            //alert(id+" ->" + selectedCountry);
            var value = selectObject.value;
            alert(item +"->" +value);
            var val='';
            switch (value) {
                case '0':
                    $('#'+id).css("color","black");
                    val='new';
                    break;
                case '1':
                    $('#'+id).css("color","blue");
                    val='start';
                    break;
                case '2':
                    $('#'+id).css("color","blue");
                    val='closed';
                    break;
                case '3':
                    $('#'+id).css("color","red");
                    val='completed';
                    break;
                case '4':
                    $('#'+id).css("color","blue");
                    val='deleted';
                    break;
                case '5':
                    $('#'+id).css("color","red");
                    val='ended';
                    break;
                default:
                    $('#'+id).css("color","red");
                    val='error';
                    break;
            }
            var  data = new FormData();
            data.append('table', 'challenge');
            data.append('cid', item);
            data.append('value', val);
            $.ajax({
                type: "POST",
                url: '{{url('/challenge/permission')}}',
                data:data ,
                processData: false, // high importance!
                contentType:false ,
                cache: false,
                async:true,
                enctype:'multipart/form-data',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response){
                    console.log(response);
                    // var obj = JSON.parse(response);
                    //alert(obj.message);
                    // console.log(obj);
                 location.reload();
                },
                error: function(response){

                    console.log(response);
                    alert('error');

                }
            });

        }
        function readURL(input) {
            //alert("asdf");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    //alert(e.target.result);
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }imagePreview
        $("#imageUpload").change(function() {
            //alert("asdf");
            readURL(this);
        });

        //-------------------------------------------------
        $('#submit_btn111').click(function(){

            var bg = $('#imageUpload').val().match(/[-_\w]+[.][\w]+$/i)[0];
            bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
            var title = $('#title').val();
            var price = $('#price').val();
            var description = $('#description').val();

            var period = $('#period_id').children("option:selected").val();
            var type= $("input:radio[name='group1']:checked").val();
            var photo_count= $("input:radio[name='group2']:checked").val();
            var prize = $('#flip').val()+','+$('#charge').val()+','+$('#wand').val();




            if(!title || !period || !type || !description || !price || !prize ) {
                alert("Input your information correctly");
                return;
            }
            var  data = new FormData();
            data.append('image', $("#imageUpload")[0].files[0]);
            data.append('title', title);
            data.append('price', price);
            data.append('prize', prize);
            data.append('period', period);
            data.append('type', type);
            data.append('photocount', photo_count);
            data.append('description', description);
            $.ajax({

                type: "POST",
                url: '{{url('/challenge/upload')}}',
                data:data ,
                processData: false, // high importance!
                contentType:false ,
                cache: false,
                async:true,
                enctype:'multipart/form-data',

                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response){
                    console.log(response);
                    //var obj = JSON.parse(response);
                    //alert(obj.message);
                    $('#exampleModalCenter').modal('toggle');
                    //console.log(response);

                    // window.location.replace('./challenges/my');

                },
                error: function(response){

                    console.log(response);
                    alert('error');

                }
            });


        });
        //    --------------------------------------------

    </script>
@stop
