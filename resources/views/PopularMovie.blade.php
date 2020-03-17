<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test AA International</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #2e3436;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
               /* height: 100vh;*/
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
                /*right: 10px;
                top: 18px;*/
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #2e3436;
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
        </style>

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    <h3> Popular </h3>
                </div>

                <?php
                $no= (( $current_page * 20)+1) -20;

                ?>
                <table border="1" class="table table-striped table-hovered" cellpadding="1" cellspacing="1"  style="color:#2e3436">
                    <thead>
                    <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Poster
                    </th>

                    <th>
                        Title
                    </th>

                    <th>
                        Genres
                    </th>
                        <th> Popularity</th>
                    <th>
                        Vote Count/Average
                    </th>
                    <th>
                        Overview
                    </th>
                    <th>
                       Release Date
                    </th>
                    </tr>
                    </thead>

                <tbody>
                @foreach($results as $result)
                <tr>
                <td>
                    {{ $no }}
                </td>
                    <td>
                    <img src="https://image.tmdb.org/t/p/w200{{$result->poster_path}}" alt="image">
                    </td>
                    <td>
                        {{ $result->title }}
                    </td>

                    <td>
                        <?php
                            $genre_text = [];
                        foreach($result->genre_ids as $gnr_id)
                            {
                                $genre_text[] = $genres[$gnr_id];
                            }

                            echo implode(', ',$genre_text);
                        ?>
                    </td>

                    <td>
                        @if(isset($result->popularity)) {{ $result->popularity }} @endif
                    </td>


                    <td>
                   @if(isset($result->vote_count)) {{ $result->vote_count }}  / @endif

                       @if(isset($result->vote_average))   {{ $result->vote_average }} @endif
                </td>

                    <td>
                        {{ $result->overview }}
                    </td>

                    <td>
                        {{ $result->release_date }}
                    </td>
                </tr>
                    <?php $no++; ?>
                    @endforeach
                </tbody>

                </table>


                <div class="links">
                    Page : {{ $current_page }} / {{ $total_pages }}
                </div>
            </div>
        </div>
    </body>
</html>
