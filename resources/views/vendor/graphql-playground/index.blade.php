{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<!DOCTYPE html>

<html>

<head>
    <meta charset=utf-8 />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GraphQL Playground</title>

    <link rel="stylesheet"
          href="{{\MLL\GraphQLPlayground\DownloadAssetsCommand::cssPath()}}"
    />
    <link rel="shortcut icon"
          href="{{\MLL\GraphQLPlayground\DownloadAssetsCommand::faviconPath()}}"
    />
    <script src="{{\MLL\GraphQLPlayground\DownloadAssetsCommand::jsPath()}}"></script>
</head>

<body>

<div id="root"/>
<script type="text/javascript">
    window.addEventListener("load", function () {
        const root = document.getElementById("root");

        GraphQLPlayground.init(root, {
            endpoint: "{{url(config('graphql-playground.endpoint'))}}",
            subscriptionEndpoint: "{{config('graphql-playground.subscriptionEndpoint')}}",
            settings: {
                "request.credentials": "same-origin",
                "request.globalHeaders": {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            }
        })
    })
</script>

</body>
</html>
