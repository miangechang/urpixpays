
@extends('Admin.Layout.dashboard1')
@section('head')
    <style>
        select{
            border: 0;
            width: 100%;
        }
    </style>



    <!-- ----------------Model Dialogue------------- -->
    <style type="text/css">


    /*                      .style9*/
    /*                      {*/
    /*                          border-radius: 15px;*/
    /*                          border: solid 1px #8E96BD;*/
    /*                          background-color: #D9F6FA;*/
    /*                          box-shadow: inset 0 3px 10px #6B9EA8;*/
    /*                          padding: 5px 10px;*/
    /*                          color: #005;*/
    /*                      }*/
    /*.style9*/
    /*{*/
    /*    box-shadow: inset 0 3px 10px #6B9EA8, 0 0 5px  #6B9EA8;*/
    /*}*/
    /*</style>*/
    /*<style type="text/css">*/

        *, *:before, *:after {
            box-sizing: border-box;
            outline: none;
        }
        button {
            cursor: pointer;
        }

        .trigger {
            margin: 0 0.75rem;
            padding: 0.625rem 1.25rem;
            border: none;
            border-radius: 0.25rem;
            box-shadow: 0 0.0625rem 0.1875rem rgba(0, 0, 0, 0.12), 0 0.0625rem 0.125rem rgba(0, 0, 0, 0.24);
            transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-size: 0.875rem;
            font-weight: 300;
        }
        .trigger i {
            margin-right: 0.3125rem;
        }
        .trigger:hover {
            box-shadow: 0 0.875rem 1.75rem rgba(0, 0, 0, 0.25), 0 0.625rem 0.625rem rgba(0, 0, 0, 0.22);
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 0vh;
            background-color: transparent;
            overflow: hidden;
            transition: background-color 0.25s ease;
            z-index: 9999;
        }
        .modal.open {
            position: fixed;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            transition: background-color 0.25s;
        }
        .modal.open > .content-wrapper {
            transform: scale(1);
        }
        .modal .content-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 50%;
            margin: 0;
            padding: 2.5rem;
            background-color: white;
            border-radius: 0.3125rem;
            box-shadow: 0 0 2.5rem rgba(0, 0, 0, 0.5);
            transform: scale(0);
            transition: transform 0.25s;
            transition-delay: 0.15s;
        }
        .modal .content-wrapper .close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border: none;
            background-color: transparent;
            font-size: 1.5rem;
            transition: 0.25s linear;
        }
        .modal .content-wrapper .close:before, .modal .content-wrapper .close:after {
            position: absolute;
            content: '';
            width: 1.25rem;
            height: 0.125rem;
            background-color: black;
        }
        .modal .content-wrapper .close:before {
            transform: rotate(-45deg);
        }
        .modal .content-wrapper .close:after {
            transform: rotate(45deg);
        }
        .modal .content-wrapper .close:hover {
            transform: rotate(360deg);
        }
        .modal .content-wrapper .close:hover:before, .modal .content-wrapper .close:hover:after {
            background-color: tomato;
        }
        .modal .content-wrapper .modal-header {
            position: relative;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin: 0;
            padding: 0 0 1.25rem;
        }
        .modal .content-wrapper .modal-header h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .modal .content-wrapper .content {
            position: relative;
            display: flex;
        }
        .modal .content-wrapper .content p {
            font-size: 0.875rem;
            line-height: 1.75;
        }
        .modal .content-wrapper .modal-footer {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
            margin: 0;
            padding: 1.875rem 0 0;
        }
        .modal .content-wrapper .modal-footer .action {
            position: relative;
            margin-left: 0.625rem;
            padding: 0.625rem 1.25rem;
            border: none;
            background-color: slategray;
            border-radius: 0.25rem;
            color: white;
            font-size: 0.87rem;
            font-weight: 300;
            overflow: hidden;
            z-index: 1;
        }
        .modal .content-wrapper .modal-footer .action:before {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            transition: width 0.25s;
            z-index: 0;
        }
        .modal .content-wrapper .modal-footer .action:first-child {
            background-color: #2ecc71;
        }
        .modal .content-wrapper .modal-footer .action:last-child {
            background-color: #e74c3c;
        }
        .modal .content-wrapper .modal-footer .action:hover:before {
            width: 100%;
        }
        h3 {
            border-bottom: 2px solid red;

        }
    	.modal {
  display: none;
  background-color: transparent;
  transition: all 0.25s ease;
}

.modal.open {
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal .content-wrapper {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  width: 50%;
  margin: 0;
  padding: 2.5rem;
  background-color: white;
  border-radius: 0.3125rem;
  box-shadow: 0 0 2.5rem rgba(0, 0, 0, 0.5);
}

.modal .content-wrapper .close {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2.5rem;
  height: 2.5rem;
  border: none;
  background-color: transparent;
  font-size: 1.5rem;
  transition: 0.25s linear;
}

.modal .content-wrapper .close:before, .modal .content-wrapper .close:after {
  position: absolute;
  content: '';
  width: 1.25rem;
  height: 0.125rem;
  background-color: black;
}

.modal .content-wrapper .close:before { transform: rotate(-45deg); }

.modal .content-wrapper .close:after { transform: rotate(45deg); }

.modal .content-wrapper .close:hover { transform: rotate(360deg); }

.modal .content-wrapper .close:hover:before, .modal .content-wrapper .close:hover:after { background-color: tomato; }

.modal .content-wrapper .modal-header {
  position: relative;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  margin: 0;
  padding: 0 0 1.25rem;
}

.modal .content-wrapper .modal-header h2 {
  font-size: 1.5rem;
  font-weight: bold;
}

.modal .content-wrapper .content {
  position: relative;
  display: flex;
}

.modal .content-wrapper .content p {
  font-size: 0.875rem;
  line-height: 1.75;
}

.modal .content-wrapper .modal-footer {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  width: 100%;
  margin: 0;
  padding: 1.875rem 0 0;
}

.modal .content-wrapper .modal-footer > button {
  margin-left: 0.625rem;
  padding: 0.625rem 1.25rem;
  border: none;
  background-color: slategray;
  color: white;
  font-size: 0.87rem;
  font-weight: 300;
}

.modal .content-wrapper .modal-footer > button:first-child { background-color: #2ecc71; }

.modal .content-wrapper .modal-footer > button:last-child { background-color: #e74c3c; }
    </style>




@stop

@section('content')
<div data-modal="trigger-demo" class="modal">
       <article class="content-wrapper">
            <button class="close"></button>
            <h3><div id="email" style="width:500px; text-align:center">jack frank</div></h3>
            <div class="row" style = "text-align:center;">
                <div class="col-6" style ="margin-top:20px; ">
                    <span>Flip:</span>
                    <input type="number" class="style9" id = "d1" name="flip"   style="border-radius: 5px;">
                </div>
                <div class="col-6" style ="margin-top:20px; ">
                    <span>Charge:</span>
                    <input type="number" class="style9" id = "d2" name="flip" size="10" style="border-radius: 5px;">
                </div>
                <div class="col-6" style ="margin-top:20px;  ">
                    <span>Wand:</span>
                    <input type="number" class="style9" id = "d3" name="flip" size="10" style="border-radius: 5px;">
                </div>
                <div class="col-6" style ="margin-top:20px; ">
                    <span>Wallet:</span>
                    <input type="number" class="style9" id = "d4" name="flip" size="10" style="border-radius: 5px;">
                </div>
                <div class="col-6" style ="margin-top:20px;  ">
                    <span>Points:</span>
                    <input type="number" class="style9" id = "d5" name="flip" size="10" style="border-radius: 5px;">
                </div>
                <div class="col-6" style ="margin-top:20px;  ">
                    <span>Points:</span>
                    <input type="number" class="style9" id = "d6" name="flip" size="10" style="border-radius: 5px;">
                </div>
            </div>
            <footer class="modal-footer">
                <button class="action send_data style9" data-modal-trigger="trigger-1">Save</button> 
               
            </footer>
        </article>
</div>

    <!--<div data-modal="trigger-1" class="modal">-->
    <!--    <article class="content-wrapper">-->
    <!--        <button class="close"></button>-->
    <!--        <h3><div id="email" style="width:500px; text-align:center">jack frank</div></h3>-->
    <!--        <div class="row" style = "text-align:center;">-->
    <!--            <div class="col-6" style ="margin-top:20px; ">-->
    <!--                <span>Flip:</span>-->
    <!--                <input type="number" class="style9" id = "d1" name="flip"   style="border-radius: 5px;">-->
    <!--            </div>-->
    <!--            <div class="col-6" style ="margin-top:20px; ">-->
    <!--                <span>Charge:</span>-->
    <!--                <input type="number" class="style9" id = "d2" name="flip" size="10" style="border-radius: 5px;">-->
    <!--            </div>-->
    <!--            <div class="col-6" style ="margin-top:20px;  ">-->
    <!--                <span>Wand:</span>-->
    <!--                <input type="number" class="style9" id = "d3" name="flip" size="10" style="border-radius: 5px;">-->
    <!--            </div>-->
    <!--            <div class="col-6" style ="margin-top:20px; ">-->
    <!--                <span>Wallet:</span>-->
    <!--                <input type="number" class="style9" id = "d4" name="flip" size="10" style="border-radius: 5px;">-->
    <!--            </div>-->
    <!--            <div class="col-6" style ="margin-top:20px;  ">-->
    <!--                <span>Points:</span>-->
    <!--                <input type="number" class="style9" id = "d5" name="flip" size="10" style="border-radius: 5px;">-->
    <!--            </div>-->
    <!--            <div class="col-6" style ="margin-top:20px;  ">-->
    <!--                <span>Points:</span>-->
    <!--                <input type="number" class="style9" id = "d6" name="flip" size="10" style="border-radius: 5px;">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <footer class="modal-footer">-->
    <!--            <button class="action send_data style9" data-modal-trigger="trigger-1">Save</button>-->
    <!--            <button class="action" data-modal-trigger="trigger-1">Cancel</button>-->
    <!--        </footer>-->
    <!--    </article>-->
    <!--</div>-->


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Admin Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                No
                            </th>
                            <th>
                                ID
                            </th>                            
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone Number
                            </th>
                            <th>
                                Role
                            </th>

                            <th>
                                Register date
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
                                        {{$item['name']}}
                                    </td>

                                    <td>
                                        {{$item['email']}}
                                    </td>
                                    <td>
                                        {{$item['phone_number']}}
                                    </td>
                                    <td>
                                        {{$item['role']}}
                                    </td>

                                    <td>

                                        {{$item['register_date']}}
                                    </td>
                                    <td>

                                    </td>
                                    <td >
                                        
                                       
                                       
                                    </td>
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

            var value = selectObject.value;
            // alert('name->' +$item['name']);
            switch (value) {
                case '0':
                    $('#'+id).css("color","black");
                    break;
                case '1':
                    $('#'+id).css("color","blue");
                    break;
                default:
                    $('#'+id).css("color","red");
                    break;
            }


        }
        $('.u_pix_btn').click(function(){

            var btn_id = $(this).attr('id');
            var btn_name = $(this).attr('name');

            $("#email").text(btn_name);

            $.ajax({
                url: '{{url('view/userpix')}}',
                type: 'post',
                data: { uid:btn_id} ,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response){
                    //alert(obj);
                  
                    var obj = JSON.parse(response);
                    console.log(obj);
                    console.log(obj.data.no);
                    $("#email").val(btn_name);
                    $("#email1").val(btn_name);
                    $("#d1").val(obj.data.Flip);
                    $("#d2").val(obj.data.Charge);
                    $("#d3").val(obj.data.Wand);
                    $("#d4").val(obj.data.walet);
                    $("#d5").val(obj.data.Points);
                    $("#d6").val(obj.data.rank);



                    $('.send_data').click(function(){

                        var Flip1 = $("#d1").val();
                        var Charge1 = $("#d2").val();
                        var Wand1 = $("#d3").val();
                        var walet1 = $("#d4").val();
                        var Points1 = $("#d5").val();
                        var rank1 = $("#d6").val();
                        $.ajax({
                            url: '{{url('updateuserpix')}}',
                            type: 'post',
                            data: { uid: obj.data['u-id'] , Charge: Charge1, Flip:Flip1, Points:Points1, Wand: Wand1, no:obj.data.no, rank:rank1, walet:walet1},
                            beforeSend: function (request){
                                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                            },
                            success: function(response){
                                //alert(obj);
                                var obj = JSON.parse(response);
                                console.log(obj);



                            },
                            error: function (response) {
                                alert('error');
                                console.log(response);
                            }
                        });
                    });

                },
                error: function (response) {
                    alert('error');
                    console.log(response);
                }
            });

        });

        // ------------------Send the dialogue's data---------------





    </script>
<script type="text/javascript">
	const buttons = document.querySelectorAll(`button[data-modal-trigger]`);

for(let button of buttons) {
  modalEvent(button);
}

function modalEvent(button) {
  button.addEventListener('click', () => {
    const trigger = button.getAttribute('data-modal-trigger');
    const modal = document.querySelector(`[data-modal=${trigger}]`);
    const contentWrapper = modal.querySelector('.content-wrapper');
    const close = modal.querySelector('.close');

    close.addEventListener('click', () => modal.classList.remove('open'));
    modal.addEventListener('click', () => modal.classList.remove('open'));
    contentWrapper.addEventListener('click', (e) => e.stopPropagation());

    modal.classList.toggle('open');
  });
}
</script>


@stop

