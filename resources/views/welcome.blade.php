<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <input type="text" data-autocomplete>

            <br>

            <ul data-results></ul>
        </div>

        <script>
            const input = document.querySelector('[data-autocomplete]')
            const results = document.querySelector('[data-results]')

            const fetchData = _.debounce(async function (search) {
                const response = await fetch(`/api/users?search=${search}`)
                const data = await response.json()

                results.innerHTML = data
                    .map(user => `<li>${user.email}</li>`)
                    .join('')
            }, 500)

            input.addEventListener('keyup', e => {
               fetchData(e.target.value)
            })

        </script>
    </body>
</html>
