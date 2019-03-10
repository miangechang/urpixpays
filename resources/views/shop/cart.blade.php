@extends('Layout.page1')

@section('lib')

@stop

@section('style-css')


@stop
@section('content')
    @php

            @endphp

<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

#customers td, #customers th {
 
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2; border-radius:4px;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
{{------------------button---------}}
    <style>



        .button::-moz-focus-inner{
            border: 0;
            padding: 0;
        }

        .button{
            display: inline-block;
            *display: inline;
            zoom: 1;
            padding: 6px 20px;
            margin: 0;
            cursor: pointer;
            border: 1px solid #bbb;
            overflow: visible;
            font: bold 13px arial, helvetica, sans-serif;
            text-decoration: none;
            white-space: nowrap;
            color: white;

            background-color: green;
            background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,1)), to(rgba(255,255,255,0)));
            background-image: -webkit-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
            background-image: -moz-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
            background-image: -ms-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
            background-image: -o-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
            background-image: linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));

            -webkit-transition: background-color .2s ease-out;
            -moz-transition: background-color .2s ease-out;
            -ms-transition: background-color .2s ease-out;
            -o-transition: background-color .2s ease-out;
            transition: background-color .2s ease-out;
            background-clip: padding-box; /* Fix bleeding */
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
            -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
            box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
            text-shadow: 0 1px 0 rgba(255,255,255, .9);

            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .button:hover{
            background-color: #eee;
            color: #555;
        }

        .button:active{
            background: #e9e9e9;
            position: relative;
            top: 1px;
            text-shadow: none;
            -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
        }

        .button[disabled], .button[disabled]:hover, .button[disabled]:active{
            border-color: #eaeaea;
            background: #fafafa;
            cursor: default;
            position: static;
            color: #999;
            /* Usually, !important should be avoided but here it's really needed :) */
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            text-shadow: none !important;
        }

        /* Smaller buttons styles */

        .button.small{
            padding: 4px 12px;
        }

        /* Larger buttons styles */

        .button.large{
            padding: 12px 30px;
            text-transform: uppercase;
        }

        .button.large:active{
            top: 2px;
        }

        /* Colored buttons styles */

        .button.green, .button.red, .button.blue {
            color: #fff;
            text-shadow: 0 1px 0 rgba(0,0,0,.2);

            background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,.3)), to(rgba(255,255,255,0)));
            background-image: -webkit-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
            background-image: -moz-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
            background-image: -ms-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
            background-image: -o-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
            background-image: linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
        }

        /* */

        .button.green{
            background-color: #57a957;
            border-color: #57a957;
        }

        .button.green:hover{
            background-color: #62c462;
        }

        .button.green:active{
            background: #57a957;
        }

        /* */

        .button.red{
            background-color: #ca3535;
            border-color: #c43c35;
        }

        .button.red:hover{
            background-color: #ee5f5b;
        }

        .button.red:active{
            background: #c43c35;
        }

        /* */

        .button.blue{
            background-color: #269CE9;
            border-color: #269CE9;
        }

        .button.blue:hover{
            background-color: #70B9E8;
        }

        .button.blue:active{
            background: #269CE9;
        }

        /* */

        .green[disabled], .green[disabled]:hover, .green[disabled]:active{
            border-color: #57A957;
            background: #57A957;
            color: #D2FFD2;
        }

        .red[disabled], .red[disabled]:hover, .red[disabled]:active{
            border-color: #C43C35;
            background: #C43C35;
            color: #FFD3D3;
        }

        .blue[disabled], .blue[disabled]:hover, .blue[disabled]:active{
            border-color: #269CE9;
            background: #269CE9;
            color: #93D5FF;
        }

        /* Group buttons */

        .button-group,
        .button-group li{
            display: inline-block;
            *display: inline;
            zoom: 1;
        }

        .button-group{
            font-size: 0; /* Inline block elements gap - fix */
            margin: 0;
            padding: 0;
            background: rgba(0, 0, 0, .1);
            border-bottom: 1px solid rgba(0, 0, 0, .1);
            padding: 7px;
            -moz-border-radius: 7px;
            -webkit-border-radius: 7px;
            border-radius: 7px;
        }

        .button-group li{
            margin-right: -1px; /* Overlap each right button border */
        }

        .button-group .button{
            font-size: 13px; /* Set the font size, different from inherited 0 */
            -moz-border-radius: 0;
            -webkit-border-radius: 0;
            border-radius: 0;
        }

        .button-group .button:active{
            -moz-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
            -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
            box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
        }

        .button-group li:first-child .button{
            -moz-border-radius: 3px 0 0 3px;
            -webkit-border-radius: 3px 0 0 3px;
            border-radius: 3px 0 0 3px;
        }

        .button-group li:first-child .button:active{
            -moz-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
            -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
            box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
        }

        .button-group li:last-child .button{
            -moz-border-radius: 0 3px 3px 0;
            -webkit-border-radius: 0 3px 3px 0;
            border-radius: 0 3px 3px 0;
        }

        .button-group li:last-child .button:active{
            -moz-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset;
            -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset;
            box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset;
        }
    </style>

<div style="width:60%;margin:auto;min-height: 600px;margin-bottom: 20px;font-family: Roboto Slab, Arial, Helvetica, sans-serif;
    font-size: 0.857em;
    font-weight: 500;padding: 15px 10px;
    text-align: center;
    text-transform: uppercase;
    vertical-align: middle;
    white-space: nowrap;">
    <table  border = "0" id="customers"  class = "cart_table" style = "margin:auto;">
        <thead >
            <div style = "background-color:lightblue; text-align:center">
                <tr style = "font-color:black;">
                    <th style="text-align:center ;margin-left:10px;">Images</th>
                    <th style="text-align:center;margin-left:10px;">Product</th>
                    <th style="text-align:center;margin-left:10px;">Price</th>
                    <th style="text-align:center;margin-left:10px;">Quantity</th>
                    <th style="text-align:center;margin-left:10px;">Total</th>
                    <th style="text-align:center;margin-left:10px;">Delete</th>
                </tr>
        </div>
        
        </thead>
        <tbody style = "text-align:center">
        @for($i=$count1;$i<$count2;$i++)
            <tr>
                <td styel = "border-bottom: 5px solid red;">
                    <div class="col-12" style="padding: 10px" >
                        <div style="background-image: url('{{$imgurl[$i]}}'); background-size: cover;   width:300px;height: 200px; margin: auto;margin-top:5px;">
                        </div> </div>

                    {{--<span id = "img_state">Sold By:Pix Pays</span>&nbsp;&nbsp;<button style = "border-radius:5px;">ADD TO CART</button>--}}
                </td>
                <td styel = "border-bottom: 5px solid red;">
                    <div id = "img_name">{{$imgname[$i]}}</div>
                </td>
                <td styel = "border-bottom: 5px solid red;">
                    <div id = "img_price">$12.00</div>
                </td>
                <td styel = "vertical-align: middle;">
                    <div id = "number"><input type="number" value = "0" min = "0" style = "width:60px;"></div>
                </td>
                <td styel = "vertical-align: middle;">
                    <div id = "img_price">$120.00</div>
                </td>
                <td styel = "vertical-align: middle;">
                    <a href="#" class="remove" aria-label="Remove this item" data-product_id="90" style = "text-decoration: none;">x</a>
                </td>
            </tr>
          
            <!--<tr style = "border-bottom: 5px solid red;width:100%;></tr>-->
        @endfor
           </tbody>
     </table>
     </div>
    <div style="width:60%;margin:auto;min-height: 40px;margin-bottom: 30px;">
        <div style = "float:left">
             <input type = "text" id = "poucon" size = "" style = "margin-left:70px;">
           <button class = "button" style = "padding-top: 8px;">Apply Coupon</button></div>

           <div style = "float:right"> <button class = "button" style = "padding-top: 8px; margin-right:82px;">Update</button> </div> 
    </div>
    


         
   
  

<div style = "width:30%; min-heigt:200px;  border-radius:10px;  margin:auto;margin-bottom:20px;">
   <h4> Cart totals</h4>
</div>
<div style = "width:40%; min-heigt:200px;  border-radius:10px;margin:auto;margin-bottom:20px;">
    <!--<p>Cart totals</p>-->
     <table  border = "0" id="customers"  class = "cart_table" style = "margin:auto; margin-bottom:33px;">
        <tr>
            <th style="background-color: #1d5d563d; text-align:center;">SUBTOTAL</th>
            <td style="background-color: #b5d2cf3d; text-align:center;">$78.00</td>
        </tr>
        <tr>
            <th style="background-color: #1d5d563d; text-align:center;">SHIPPING</th>
            <td style="background-color: #b5d2cf3d; text-align:center;">Enter your address to view shipping options.<br>Calculate shipping</td>   
        </tr>
        <tr>
            <th style="background-color: #1d5d563d; text-align:center;">TATAL</th>
            <td style="background-color: #b5d2cf3d; text-align:center;">$78.00</td>
        </tr> 
         
    </table>
    
    <div class = "row">
        <div class = "col-lg-6"> 
            <a href="{{url('/payment')}}"><button  class="button" style = "width:200px;height:30px; ">Pay with Paypal</button></a>
        </div>
        <div class = "col-lg-6"> 
            <a href="{{url('/payment')}}"><button  class="button" style = "width:200px;;height:30px;">Pay with Strip</button></a>
       </div>
        
            </div>
            
     
        
         
     
</div>
<div >
							
</div>





@stop
@section('javascript')
    <script>
    </script>

@stop
