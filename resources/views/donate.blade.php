@extends('layouts.app')

@section('content')

<head>

    <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">
</head>

<div class="uk-section">
    <div class="uk-container uk-container-small ">
        <div class="Donate">

            <div class="DonateDesc">

                <div id="patreon">
                    <a href="https://www.patreon.com/bePatron?u=20628380"
                        data-patreon-widget-type="become-patron-button">Become a Patron!</a>
                    <script async src="https://c6.patreon.com/becomePatronButton.bundle.js"></script>
                </div>
                <br>
                <br>
                <div id="paypal">
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="4X9NZHHDDS7KG" />
                        <input type="image" src="https://www.paypalobjects.com/en_US/RU/i/btn/btn_donateCC_LG.gif"
                            name="submit" title="PayPal - The safer, easier way to pay online!"
                            alt="Donate with PayPal button" />
                        <img alt="" src="https://www.paypal.com/en_RU/i/scr/pixel.gif" width="1" height="1" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            height: 100vh;
        }



        html,
        body {
            background:
                /* top, transparent black, faked with gradient */
                linear-gradient(rgba(0, 0, 0, 0.7),
                rgba(0, 0, 0, 0.7)),

                url('/images/510892.jpg') no-repeat center fixed;
             !important;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .patreonLogo {
            float: center;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            display: block
        }

        .DonateDesc {
            font-family: 'Bree Serif', serif;
            color: white;
            padding: 30px;
        }

        #patreon {
            text-align: center;
            display: inline;
        }

        #paypal {
            display: inline;
            text-align: center;


        }
    </style>



    @endsection