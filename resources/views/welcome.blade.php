<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        @include('layout.css-script')
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .paginationjs-pages {
                display: inline-block;
            }

            .paginationjs-pages li {
                color: black;
                float: left;
                padding: 4px 8px;
                text-decoration: none;
                border: 1px solid #ddd;
            }

            .paginationjs-pages li.active {
                background-color: #4CAF50;
                color: white;
                border: 1px solid #4CAF50;
            }

            .paginationjs-pages li:hover:not(.active) {
                background-color: #ddd;
            }

            .paginationjs-pages li:first-child {
                border-top-left-radius: 5px;
                border-bottom-left-radius: 5px;
            }

            .paginationjs-pages li:last-child {
                border-top-right-radius: 5px;
                border-bottom-right-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        <div id="data-container"></div>
        <div id="pagination-container"></div>

    
        @include('layout.js-script')
<script type="text/javascript">

    $('#pagination-container').pagination({
        dataSource: '{{ route("get_product") }}',
        locator: 'contents.data',
        totalNumberLocator: function(response) {
            // you can return totalNumber by analyzing response content
            return response.contents.total;
        },
        pageSize: 1,
        alias:{
            pageSize: 'limit',
            pageNumber: 'page',
        },
        ajax: {
            beforeSend: function() {
                $('#data-container').html('Loading data...');
            },
            data: { 
                // category:1
            }
        },
        callback: function(data, pagination) {
            // template method of yourself
            var html = simpleTemplating(data);
            $('#data-container').html(html);
        }
    });

        // this template html
        function simpleTemplating(data) {
            var html = '<table class="table table-bordered">';
            $.each(data, function(index, item){
                var id = item.id;
            var routetest = '{{ url("/product/") }}/'+id+'/detail';
            console.log(routetest);
            console.log(id);
                html += '<tr><td><image src="'+ item.images[0]['src'] +'" width="80" height="120"> '+item.name+'</td></tr>';
            });
            html += '</table>';
            
            return html;
        }
        </script>
    </body>
</html>
