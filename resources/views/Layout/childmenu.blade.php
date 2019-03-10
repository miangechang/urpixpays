<div class="child">
    <nav class="nav">
        <ul>

            <li class="drop"><a href="#">My Challengs</a>
                <ul class="dropdown custom_item">
                    <li><a href={{asset("../challenges/my")}}>Current</a></li>
                    <li><a href={{url('/challenges/pass')}}>Past</a></li>

                </ul>
            </li>
            <li><a href={{asset("../challenges/open")}}>Open</a>
            <li><a href="{{url('/challenges/closed')}}">Closed</a>
        </ul>
    </nav>
</div>
<style>

    .child h1 {
        font-weight: 200;
        font-size: 2.2rem;
        color: black;
        text-align: center;
    }

    .child nav {
        margin: 0 auto;
        /*max-width: 800px;*/
        background: white;
        box-shadow:0 3px 15px rgba(0,0,0,.15);
        position: fixed;
        width: 100%;
        top:119px;
        z-index: 9;
    }
    @media screen and (max-width:850px){
        .child nav {
            margin: 0 auto;
            /*max-width: 800px;*/
            background: white;
            box-shadow:0 3px 15px rgba(0,0,0,.15);
            position: fixed;
            width: 100%;
            top:120px;
            z-index: 9;
        }
    }

    .child nav::after {
        display: block;
        content: '';
        clear: both;
    }

    .child nav ul {
        padding: 0;
        margin: auto;
        list-style: none;
    }

    .child nav ul li {
        float: left;
        position: relative;
    }

    .child nav ul li a {
        display: block;
        color: rgba(0, 0, 0, .9);
        text-decoration: none;
        padding: 1rem 2rem;
        border-top: 2px solid transparent;
        border-bottom: 2px solid transparent;
        transition: all .3s ease-in-out;
    }

    .child nav ul li a:hover,
    .child nav ul li a:focus {
        background: rgba(0, 0, 0, .15);
    }

    .child nav ul li a:focus {
        color: white;
    }

    .child nav ul li a:not(:only-child)::after {
        padding-left: 4px;
        content: ' ▾';
    }

    .child nav ul li ul li {
        min-width: 190px;
    }

    .child nav ul li ul li a {
        background: transparent;
        color: #555;
        border-bottom: 1px solid #DDE0E7;
    }

    .child nav ul li ul li a:hover,
    .child nav ul li ul li a:focus {
        background: #eee;
        color: #111;
    }

    .child .dropdown {
        display: none;
        position: absolute;
        background: #fff;
        box-shadow: 0 4px 10px rgba(10, 20, 30, .4);
    }



</style>
<script>
    $(".drop")
        .mouseover(function() {
            $(".custom_item").show(300);
        });
    $(".drop")
        .mouseleave(function() {
            $(".custom_item").hide(300);
        });
</script>
