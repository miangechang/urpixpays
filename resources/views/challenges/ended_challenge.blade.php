@extends('Layout.gpage')

@section('lib')

@stop
<script src={{asset("/row-grid.js")}}></script>

@section('style-css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <style>

        .c-challenge-cover {
            position: relative;
            z-index: 1;
            overflow: hidden;
            width: 100%;
            height: 750px;
            background-color: #ddd;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
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
            /*background-image: url(https://photos.gurushots.com/unsafe/1582x0/c8530cf8a6bd266447926532f5669cf8/3_05b8e2ccaedaf3c64bb539c17f1ff745.jpg) !important;*/
            height:600px;
            background-repeat: no-repeat;
            background-size: cover;
        }

        h1 {
            color:white;
        }

        #photos .image {
            /* Just in case there are inline attributes */
            width: auto !important;
            height: 200px !important;
            border: solid 4px grey;
            max-width: 600px;
        }

        .image-card .number{
            font-size: 30px;
            color: white;
            position: absolute;
            top: 10px;
            left: 30px;
            text-shadow: 2px 2px 5px black;

        }
        .image-card .vote{
            font-size: 30px;
            color: white;
            position: absolute;
            bottom: 10px;
            right: 30px;
            text-shadow: 2px 2px 5px black;
        }
        .image-card .user{
            display: table-cell;
            vertical-align: middle;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            text-align: center;
            font-size: 30px;
            color: white;
            position: absolute;
            text-shadow: 2px 2px 5px black;
            transform: scale(0);
        }

        .challenge_title{
            position: relative;
        }
        .challenge_title{
            border-radius: 50%;
            background:rgba(255,255,255,0.7);
            opacity: 1;width: 250px;height: 250px;
            margin: auto;margin-bottom: 50px;
        }
        .challenge_title h1::after{
            content: '';
            position: absolute;
            left: -15px;
            top: -15px;
            width: 280px;
            height: 280px;
            border: 1px solid #F29620;
            border-radius: 50%;
            z-index: -1;
        }
        .challenge_title h1::before{
            content: '';
            position: absolute;
            left: -10px;
            top: -10px;
            width: 270px;
            height: 270px;
            border: 5px solid #F29620;
            border-radius: 50%;
            z-index: -1;
        }
        .imagediv{
            margin-bottom: 10px;
            margin: auto;
        }
        .imagediv .image-card{
            height: 150px;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .nondisplay{
            display: none;
        }
        .imagediv span{
            position: absolute;right: 0%;bottom: 0%; margin-right: 20px;
            text-shadow: 2px 2px 5px black;
            color: white;
            font-size: 25px;
        }
    </style>
@stop
@section('content')
    @php
        //echo var_dump($data);
        $c=json_decode(json_encode($data), true);
            //echo var_dump($c);
        $ranks=json_decode(json_encode($rank), true);
                //echo var_dump($image);myrank
        $myranks=json_decode(json_encode($myrank), true);
    @endphp
    <div class="c-challenge-cover contentcenter paddingtop-50 backgroundimage " style="outline: 10px solid rgba(255,255,255,0.7);
        outline-offset: -30px;padding-top: 90px;background-image: url('{{$c['image-url']}}')">
        <div style="" class="challenge_title">
            <h1 id="submit_challenge_title"  style="padding: 5px;color: black;    height: 250px;display: table-cell;vertical-align: middle;width:250px">{{$c['title']}}</h1>
        </div>
        <span id="image_gas" style="display: none">{{$c['photocount']}}</span>

        <span id="photo_submit_c_id" style="display: none">{{$c['id']}}</span>
    </div>
    {{---------------------------------------}}
    <div style="margin-top: 10px">

        <ul class="nav nav-tabs" style="background: white;margin-bottom:0;font-family: inherit;font-size: 17px;font-weight: 700;margin: auto;max-width: 1000px;">


            <li class="active"><a data-toggle="tab" href="#details"><div style="margin-bottom: 50px;  background-color:#f29620;width: 200px;
                                                                              box-shadow: 0px 15px 20px rgba(194, 116, 0,0.5);
                                                                              color: #fff;    margin-right: 20px;
                                                                               margin-left: 30px;border-radius: 20px;
                                                                              ">
                        <button type="button" class="btn "  style="width: 100%;background-color: #f29620;height: 50px;"><span style="padding-bottom: 4px;border-bottom: solid 1px;padding-left: 10px;
                                         padding-right: 10px;font-weight: bold;">Details</span>

                        </button>
                    </div>
                </a></li>
            <li ><a data-toggle="tab" href="#prize"><div style="margin-bottom: 50px;  background-color:#f29620;width: 200px;
                                                                              box-shadow: 0px 15px 20px rgba(194, 116, 0,0.5);
                                                                              color: #fff;    margin-right: 20px;
                                                                               margin-left: 30px;border-radius: 20px;
                                                                              ">
                        <button type="button" class="btn "  style="width: 100%;background-color: #f29620;height: 50px;"><span style="padding-bottom: 4px;border-bottom: solid 1px;padding-left: 10px;
                                         padding-right: 10px;font-weight: bold;">Prize</span></button>
                    </div>
                </a></li>
            <li ><a data-toggle="tab" href="#rules"><div style="margin-bottom: 50px;  background-color:#f29620;width: 200px;
                                                                              box-shadow: 0px 15px 20px rgba(194, 116, 0,0.5);
                                                                              color: #fff;    margin-right: 20px;
                                                                               margin-left: 30px;border-radius: 20px;
                                                                              ">
                        <button type="button" class="btn "  style="width: 100%;background-color: #f29620;height: 50px;"><span style="padding-bottom: 4px;border-bottom: solid 1px;padding-left: 10px;
                                         padding-right: 10px;font-weight: bold;">Rules</span></button>
                    </div>
                </a></li>
            <li ><a data-toggle="tab" href="#rank"><div style="margin-bottom: 50px;  background-color:#f29620;width: 200px;
                                                                              box-shadow: 0px 15px 20px rgba(194, 116, 0,0.5);
                                                                              color: #fff;    margin-right: 20px;
                                                                               margin-left: 30px;border-radius: 20px;
                                                                              ">
                        <button type="button" class="btn "  style="width: 100%;background-color: #f29620;height: 50px;"><span style="padding-bottom: 4px;border-bottom: solid 1px;padding-left: 10px;
                                         padding-right: 10px;font-weight: bold;">Rank</span></button>
                    </div>
                </a></li>



        </ul>

    </div>
    {{---------------------------------------}}

    <div class="tab-content">
        <div id="details" class=" container tab-pane active" style="min-height: 80%;"><br>
            <div style="text-align: center"><h2 style="color: #f29620;">{{$c['title']}}</h2></div>

            <div class="row" style="width:100%;height:320px;background: white;margin-bottom: 70px;padding-top:80px;">

                <div class="col-sm-4" style="height:100%;background:white;  border-right: 1px solid;
                                        text-align: center;padding:auto">
                    <div class="col-sm-12" style="height: 60%;background:white;
                                                                  margin: auto;">

                        <img  alt="Avatar" class="image" style="width: 98px;height: 96px;border-radius: 100%;margin: auto;" src="https://photos.gurushots.com/unsafe/500x0/ba7adc786e06f16a98b2b817295e30de/3_63110d706993e43f06a61525585c3307.jpg">
                        <h5 style="color: black">{{$c['name']}}</h5>
                    </div>
                    <div class="col-sm-12" style="height: 30%;background:white;
                                                                  margin: auto;">
                        <h6 style="border-top: 1px solid;padding: 19px"></h6>
                        <button style="font-size : 12px;margin:auto
                        ;width: 40%;border-radius: 10px;outline: none;background-color: #218ccc;color:white">FOLLOWING</button>
                    </div>

                </div>
                <div class="col-sm-8" style="height:100%;background:WHITE;margin: auto;text-align: center;padding-top: 10px">
                    <h2 style="margin-bottom: 30px;">{{$c['title']}} Challenge</h2>
                    <h6 id="submit_challege_description">{{$c['description']}}</h6>
                </div>


            </div>
        </div>
        <div id="prize" class=" container tab-pane " style="min-height: 80%;"><br>
            <div style="text-align: center"><h2 style="color: #f29620;">PRIZE</h2></div>

            <div class="row" style="width:100%;height:400px;background: white;padding-top:120px;">

                <div class="col-sm-6" style="height:100%;background:white;  border-right: 1px solid;
                            text-align: center;padding:auto">
                    <div class="col-sm-12" style="height: 70%;background:white;
                                                      margin: auto;">

                        <img  alt="Avatar" class="image" style="width: 100%;height: 196px;margin: auto;" src="https://photos.gurushots.com/unsafe/792x0/eec411c6ab7e36c00bd78109714c7447/3_267ba4ce10ecc6bda3760c921c9e3f4d.jpg">
                        <h5>GURU Stepan Chuchma</h5>
                    </div>


                </div>
                <div class="col-sm-6" style="height:100%;background:WHITE;margin: auto;text-align: center;padding-top: 10px">

                    <h3>GuruShots Bundle</h3>
                    <h6>   You will receive a GuruShots bundle with Flip, Wand and Charge({{$c['prize']}})!
                        Provided by urpixpays</h6>
                </div>

            </div>

        </div>
        <div id="rules" class=" container tab-pane " style="min-height: 80%;"><br>
            <div style="text-align: center"><h2 style="color: #f29620;">RULES</h2></div>
            <div class="" style="width: 70%;border-bottom:1px solid #f29620;margin:auto" >
                <div style="display:inline-block;magin-top:0;height: auto">
                    <img src={{asset("img/submission_rules.png")}} >
                </div>

                <div  style="height: 20%;display:inline-block;" class="col-8">
                    <div class="text">
                        <h2 ng-bind="rule.name">submission limit</h2>
                        <p ng-bind-html="rule.description">4 photo submits per participant</p>

                    </div>
                </div>
            </div>
            <div class="" style="width: 70%;height:170px;border-bottom:1px solid #f29620;margin:auto;margin-top: 20px" >
                <img src={{asset("img/level_requirment_rules.png")}} style="display:inline-block;height:150px">
                <div  style="text-align: left;height: 20%;display:inline-block;">
                    <div class="text">
                        <h2 ng-bind="rule.name">Level Requirements
                        </h2>
                        <p ng-bind-html="rule.description">Trendy - 25
                            Competent - 50
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="rank" class="tab-pane " style="min-height: 80%;">
                
                @for($i=0;$i<count($ranks);$i++)
                    @php
                        //echo count($data);
                        $item = json_decode(json_encode($ranks[$i]), true);
                    @endphp
                <div class="row" style="width: 80%;margin: auto;position: relative;margin-bottom: 20px">
                    <div class="col-12" style="height: 80px">
                        <div style="z-index:6;position:absolute;display: table;height: 80px;width: 80px;background-color: grey;border-radius: 40px;text-align: center;">
                            <span style="color: white;font-size:30px;display: table-cell;vertical-align: middle">
                                {{$item['rank']}}
                            </span>
                        </div>

                        <div style="margin-top:25px;z-index: 5;width:95%; background-color: #3b3e80;height: 30px;border-radius: 15px;position: absolute;right: 0%">
                            <span style="position: absolute;left: 10%;color: white">
                                {{$item['name']}}
                            </span>
                            <span style="position: absolute;right: 5%;color: white">
                                {{$item['vote_count']}} Votes
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id='{{$item['id']}}' class="row" style="padding-left: 50px;">
                            <span id="cid-{{$i}}" class="nondisplay">{{$item['c-id']}}</span>
                            <span id="uid-{{$i}}" class="nondisplay">{{$item['u-id']}}</span>
                            @switch($c['photocount'])
                                @case (1)
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-0" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-0" style=""></span>
                                    </div>
                                </div>
                                @break
                                @case (2)
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-0" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-0" style=""></span>
                                    </div>
                                </div>
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-1" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-1" style=""></span>
                                    </div>
                                </div>
                                @break
                                @case (4)
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-0" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-0" style=""></span>
                                    </div>
                                </div>
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-1" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-1" style=""></span>
                                    </div>
                                </div>
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-2" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-2" style=""></span>
                                    </div>
                                </div>
                                <div class="col-3 imagediv">
                                    <div id="p-{{$item['u-id']}}-3" class="image-card" style="">
                                        <span id="vote-{{$item['u-id']}}-3" style=""></span>
                                    </div>
                                </div>
                                @break
                                @default
                                @break
                            @endswitch
                        </div>
                    </div>


                </div>

                @endfor

        </div>
    </div>






@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            var count='{{count($ranks)}}';
            for (var i=0;i<count;i++){
                var cid=$('#cid-'+i).text();
                var uid=$('#uid-'+i).text();
                //console.log(cid);
                //console.log(i);
                $.ajax({
                    url: '{{url('/image/get')}}',
                    type: 'post',
                    data: { cid: cid, uid:uid} ,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function(response){
                        var obj = JSON.parse(response);
                        //alert(obj.message);
                        var images=obj.data;
                        console.log(obj);
                        var number=0;
                        for (var j=0;j<images.length;j++){
                            //alert(j);
                            $('#p-'+images[j]['u-id']+'-'+j).css("background-image",'url('+images[j]['url'])+')';
                            $('#vote-'+images[j]['u-id']+'-'+j).text(images[j]['vote']);
                            console.log('#p-'+images[j]['u-id']+'-'+j);
                            // $('#iid-'+j+'-'+images[j]['c-id']+'div').css("background-image",images[j]['url']);
                            // $('#voteid-'+j+'-'+images[j]['c-id']).text(images[j]['vote']);
                            // $('#imageid-'+j+'-'+images[j]['c-id']).text(images[j]['id']);
                            // number+=parseInt(images[j]['vote']);
                            //!!
                            //console.log(images[j]['url']);
                            //console.log('#iid-'+j+'-'+images[j]['c-id']);
                        }
                        if(images.length>0)
                            $('#vote'+images[0]['c-id']).text(number);

                    },
                    error: function (response) {
                        console.log(response);
                    }

                });
                //------------------------------------Disply Exposure-----------------------------------------------------

                //-----------------------------------------------------------------------------------------------------------------
            }

        });



        //----------------------------------------------------------------------

    </script>

@stop
@include ('Modal/photo_submit')
@include ('Modal/swap_dlg')
@include ('Modal/submit_dlg')


