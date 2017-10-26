<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Agency - Start Bootstrap Theme</title>
    <!-- Bootstrap Core CSS -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <script src="/js/app.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" class="index">


<section id="services">
    <div class="container">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </div>
        @endif
        @yield('content')
        <div class="row">
            <h2>API example</h2>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Add item</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body"><h4>POST:</h4>
                            <pre>
                              <code>
URL:/api/v1/item/add
                              </code>
                              <code>
{
"title": 21,
"image_path": "http://via.placeholder.com/350x150"
}
                              </code>

                            </pre>
                            <h4>Response:</h4>
                            <pre>
                              <code>
{
"title": "23132131",
"image_path": "323323213",
"slug": "23132131-6",
"updated_at": "2017-10-26 06:27:35",
"created_at": "2017-10-26 06:27:35",
"id": 33
}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Show item by id</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h4>GET:</h4>
                             <pre>
                              <code>
URL:/api/v1/item/show/{id}
PARAM: id=int
                              </code>

                            </pre>
                            <h4>Response:</h4>
                            <pre>
                              <code>
{
"id": 33,
"title": "23132131",
"slug": "23132131-6",
"image_path": "323323213",
"created_at": "2017-10-26 06:27:35",
"updated_at": "2017-10-26 06:27:35"
}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Show item by slug</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h4>GET:</h4>
                            <pre>
                              <code>
URL: /api/v1/item/show/{slug}
                              </code>

                            </pre>
                            <h4>Response:</h4>
                            <pre>
                              <code>
{
"id": 33,
"title": "23132131",
"slug": "23132131-6",
"image_path": "323323213",
"created_at": "2017-10-26 06:27:35",
"updated_at": "2017-10-26 06:27:35"
}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                Show all items</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h4>GET:</h4>
                            <pre>
                              <code>
URL: /api/v1/item/all
PARAM: random:1
                              </code>

                            </pre>
                            <h4>Response:</h4>
                            <pre>
                              <code>
[
  {
"id": 21,
"title": "tet",
"slug": "tset",
"image_path": "/images/1508912425.png",
"created_at": "2017-10-25 06:20:25",
"updated_at": "2017-10-25 06:20:25",
"rate": 12
},
  {
"id": 23,
"title": "test1",
"slug": "test1",
"image_path": "/images/1508913816.png",
"created_at": "2017-10-25 06:43:36",
"updated_at": "2017-10-25 06:43:36",
"rate": 7
}
],
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                Set rating for selected item. Other items will get "-1" </a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h4>GET:</h4>
                            <pre>
                              <code>
URL: /api/v1/item/set-ratings
                              </code>
                              <code>
{
id:1
other_ids:[23,24]
}
                              </code>
                            </pre>
                            <h4>Response:</h4>
                            <pre>
                              <code>
[
  {
"id": 21,
"title": "tet",
"slug": "tset",
"image_path": "/images/1508912425.png",
"created_at": "2017-10-25 06:20:25",
"updated_at": "2017-10-25 06:20:25",
"rate": 12
},
  {
"id": 23,
"title": "test1",
"slug": "test1",
"image_path": "/images/1508913816.png",
"created_at": "2017-10-25 06:43:36",
"updated_at": "2017-10-25 06:43:36",
"rate": 7
}
],
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                Set rating for one item</a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h4>GET:</h4>
                            <pre>
                              <code>
URL: /api/v1/item/set-rating-one-item
                              </code>
                                <code>
{
id:23,
rating:1
}
                              </code>
                            </pre>
                            <h4>Response:</h4>
                            <pre>
                              <code>
{
"id": 23,
"title": "test1",
"slug": "test1",
"image_path": "/images/1508913816.png",
"created_at": "2017-10-25 06:43:36",
"updated_at": "2017-10-25 06:43:36",
"rate": 7
}
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>