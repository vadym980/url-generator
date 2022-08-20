<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gerenating short URL</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    </head>
    <body class="antialiased relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <div class="container">
            <div class="row">
                <h1>Generate short Url link</h1>
            </div>
            <div class="row">
                <img id="loader" scr="public/img/ajax_preloader.gif">
                <form id="form">
                    @csrf
                    <div class="mb-3">
                        <label for="urlInput" class="form-label">Paste URL in window below</label>
                        <input type="text" name="url" value="" class="form-control" id="urlInput" placeholder="https://google.com" minlength="3" required>
                    </div>
                    <div id="validationServerUsernameFeedback" class="mb-3 invalid-feedback" style="display:none">
                        Probably your url already exist in database, please watch carefully list below
                    </div>
                    <div class="mb-3 justify-content-center">
                        <input type="submit" class="btn btn-primary" value="Send">
                    </div>
                </form>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h3>List of short links</h3>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Url</th>
                                    <th>Short URL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @isset($links)
                                @foreach($links as $link)
                                    <tr>
                                        <td>
                                            {{ $link->url }}
                                        </td>
                                        <td>
                                            <a href="{{ $link->url_short }}">{{ $link->url_short }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endisset
                                @empty($link->url_short)
                                    <tr id="noLinks"><td>Here is no links yet</td><td></td></tr>
                                @endempty
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('assets/js/site.js') }}"></script>
    </body>
</html>
