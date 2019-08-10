@include('layouts.app')
@extends('layouts.headers')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js') }}"></script>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Premium Duels</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>



<body>



    <div class="bgimg-1">
        <div class="caption">
            <span class="border notransition">Premium Duels</span>
        </div>
    </div>

    <div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">About</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac cursus nulla. Nulla volutpat aliquam felis
            vel porttitor. Nullam sit amet finibus turpis, et consectetur lacus. Vivamus faucibus consectetur ex sed
            molestie. Donec a neque eu massa suscipit imperdiet. Cras dignissim quam sit amet aliquet accumsan.
            Suspendisse vulputate, urna sed luctus iaculis, sapien tortor condimentum lectus, at iaculis elit arcu ac
            purus. Nulla faucibus neque ut diam bibendum scelerisque. Integer a quam magna. Praesent scelerisque dapibus
            leo, ac viverra nunc. Quisque pretium hendrerit eleifend. Sed vel augue vitae lacus laoreet pretium.

            Etiam suscipit suscipit faucibus. Fusce pharetra orci neque, eget malesuada diam egestas ac. Vestibulum
            accumsan nisi ac est commodo, sit amet tempus sapien molestie. Integer non ante quam. Integer vel nisl
            tempus, pellentesque ipsum sit amet, elementum erat. Phasellus eu ligula ut ex iaculis vulputate at ut
            mauris. Fusce faucibus erat sit amet lobortis ultrices.

            Ut vitae lacus sed metus pretium pretium quis at magna. Pellentesque orci nisl, bibendum sed suscipit vitae,
            iaculis a est. Aliquam fringilla mi non sem dignissim iaculis. Vivamus mollis eros et felis malesuada, eget
            vulputate diam suscipit. Quisque dignissim vel leo quis maximus. Maecenas in enim lacinia, bibendum metus
            et, laoreet lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
            Etiam luctus purus tortor, quis aliquet turpis laoreet nec. Donec posuere fermentum lectus in convallis.
            Morbi vitae semper arcu, a aliquet quam. Maecenas efficitur tincidunt elit vitae hendrerit. Vivamus
            tincidunt pretium lectus at pulvinar.</p>
    </div>

    <div class="bgimg-2">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">Rating
                System</span>
        </div>
    </div>

    <div style="position:relative;">
        <div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac cursus nulla. Nulla volutpat aliquam
                felis vel porttitor. Nullam sit amet finibus turpis, et consectetur lacus. Vivamus faucibus consectetur
                ex sed molestie. Donec a neque eu massa suscipit imperdiet. Cras dignissim quam sit amet aliquet
                accumsan. Suspendisse vulputate, urna sed luctus iaculis, sapien tortor condimentum lectus, at iaculis
                elit arcu ac purus. Nulla faucibus neque ut diam bibendum scelerisque. Integer a quam magna. Praesent
                scelerisque dapibus leo, ac viverra nunc. Quisque pretium hendrerit eleifend. Sed vel augue vitae lacus
                laoreet pretium. Etiam suscipit suscipit faucibus. Fusce pharetra orci neque, eget malesuada diam
                egestas ac. Vestibulum accumsan nisi ac est commodo, sit amet tempus sapien molestie. Integer non ante
                quam. Integer vel nisl tempus, pellentesque ipsum sit amet, elementum erat. Phasellus eu ligula ut ex
                iaculis vulputate at ut mauris. Fusce faucibus erat sit amet lobortis ultrices. Ut vitae lacus sed metus
                pretium pretium quis at magna. Pellentesque orci nisl, bibendum sed suscipit vitae, iaculis a est.
                Aliquam fringilla mi non sem dignissim iaculis. Vivamus mollis eros et felis malesuada, eget vulputate
                diam suscipit. Quisque dignissim vel leo quis maximus. Maecenas in enim lacinia, bibendum metus et,
                laoreet lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                Etiam luctus purus tortor, quis aliquet turpis laoreet nec. Donec posuere fermentum lectus in convallis.
                Morbi vitae semper arcu, a aliquet quam. Maecenas efficitur tincidunt elit vitae hendrerit. Vivamus
                tincidunt pretium lectus at pulvinar.</p>
        </div>
    </div>

    <div class="bgimg-3">
        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">Ranking
                Systems</span>
        </div>
    </div>

    <div style="position:relative;">
        <div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac cursus nulla. Nulla volutpat aliquam
                felis vel porttitor. Nullam sit amet finibus turpis, et consectetur lacus. Vivamus faucibus consectetur
                ex sed molestie. Donec a neque eu massa suscipit imperdiet. Cras dignissim quam sit amet aliquet
                accumsan. Suspendisse vulputate, urna sed luctus iaculis, sapien tortor condimentum lectus, at iaculis
                elit arcu ac purus. Nulla faucibus neque ut diam bibendum scelerisque. Integer a quam magna. Praesent
                scelerisque dapibus leo, ac viverra nunc. Quisque pretium hendrerit eleifend. Sed vel augue vitae lacus
                laoreet pretium. Etiam suscipit suscipit faucibus. Fusce pharetra orci neque, eget malesuada diam
                egestas ac. Vestibulum accumsan nisi ac est commodo, sit amet tempus sapien molestie. Integer non ante
                quam. Integer vel nisl tempus, pellentesque ipsum sit amet, elementum erat. Phasellus eu ligula ut ex
                iaculis vulputate at ut mauris. Fusce faucibus erat sit amet lobortis ultrices. Ut vitae lacus sed metus
                pretium pretium quis at magna. Pellentesque orci nisl, bibendum sed suscipit vitae, iaculis a est.
                Aliquam fringilla mi non sem dignissim iaculis. Vivamus mollis eros et felis malesuada, eget vulputate
                diam suscipit. Quisque dignissim vel leo quis maximus. Maecenas in enim lacinia, bibendum metus et,
                laoreet lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                Etiam luctus purus tortor, quis aliquet turpis laoreet nec. Donec posuere fermentum lectus in convallis.
                Morbi vitae semper arcu, a aliquet quam. Maecenas efficitur tincidunt elit vitae hendrerit. Vivamus
                tincidunt pretium lectus at pulvinar.</p>
        </div>
    </div>

    <div class="bgimg-1">

        <div class="caption">
            <span class="border" style="background-color:transparent;font-size:25px;color: white">Charts &&
                Statistics</span>

        </div>
    </div>
    <div style="position:relative;">
        <div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac cursus nulla. Nulla volutpat aliquam
                felis vel porttitor. Nullam sit amet finibus turpis, et consectetur lacus. Vivamus faucibus consectetur
                ex sed molestie. Donec a neque eu massa suscipit imperdiet. Cras dignissim quam sit amet aliquet
                accumsan. Suspendisse vulputate, urna sed luctus iaculis, sapien tortor condimentum lectus, at iaculis
                elit arcu ac purus. Nulla faucibus neque ut diam bibendum scelerisque. Integer a quam magna. Praesent
                scelerisque dapibus leo, ac viverra nunc. Quisque pretium hendrerit eleifend. Sed vel augue vitae lacus
                laoreet pretium. Etiam suscipit suscipit faucibus. Fusce pharetra orci neque, eget malesuada diam
                egestas ac. Vestibulum accumsan nisi ac est commodo, sit amet tempus sapien molestie. Integer non ante
                quam. Integer vel nisl tempus, pellentesque ipsum sit amet, elementum erat. Phasellus eu ligula ut ex
                iaculis vulputate at ut mauris. Fusce faucibus erat sit amet lobortis ultrices. Ut vitae lacus sed metus
                pretium pretium quis at magna. Pellentesque orci nisl, bibendum sed suscipit vitae, iaculis a est.
                Aliquam fringilla mi non sem dignissim iaculis. Vivamus mollis eros et felis malesuada, eget vulputate
                diam suscipit. Quisque dignissim vel leo quis maximus. Maecenas in enim lacinia, bibendum metus et,
                laoreet lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                Etiam luctus purus tortor, quis aliquet turpis laoreet nec. Donec posuere fermentum lectus in convallis.
                Morbi vitae semper arcu, a aliquet quam. Maecenas efficitur tincidunt elit vitae hendrerit. Vivamus
                tincidunt pretium lectus at pulvinar.</p>
        </div>
    </div>




    <script src=" {{ asset('js/app.js') }}"></script>
</body>

</html>


<style>
    .col-centered {
        float: none;
        margin: 0 auto;
    }


    body,
    html {
        height: 100%;
        margin: 0;
        font: 400 15px/1.8 "Lato", sans-serif;
        color: #777;
    }

    .bgimg-1,
    .bgimg-2,
    .bgimg-3,
    .bgimg-4 {
        position: relative;
        opacity: 0.65;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

    }

    .bgimg-1 {
        background-image: url("/images/bg.png");
        min-height: 100%;

    }

    .bgimg-2 {
        background-image: url("/images/kcdArt1.jpg");
        min-height: 400px;

    }

    .bgimg-3 {
        background-image: url("/images/510892.jpg");
        min-height: 400px;

    }

    .bgimg-4 {
        background-image:
            url("/images/510892.jpg") !important;
        min-height: 400px;

    }

    .caption {
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        text-align: center;
        color: #000;
    }

    .caption span.border {
        background-color: rgba(255, 255, 255, 0.171);
        color: rgb(0, 0, 0);
        padding: 18px;
        font-size: 25px;
        letter-spacing: 10px;
    }

    h3 {
        letter-spacing: 5px;
        text-transform: uppercase;
        font: 20px "Lato", sans-serif;
        color: #111;
    }

    /* Turn off parallax scrolling for tablets and phones */
    @media only screen and (max-device-width: 1024px) {

        .bgimg-1,
        .bgimg-2,
        .bgimg-3 {
            background-attachment: scroll;
        }
    }


    .transition {
        -webkit-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .notransition {
        -webkit-transform: none !important;
        transform: none !important;
    }
</style>