<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado</title>
    @php
        if($data['horizontal'] == 0) {
            $size_width = 794 - 100;
            $size_height = 1123 - 100;
        }
        else {
            $size_width = 1123 - 100;
            $size_height = 794 - 100;
        }
    @endphp
    <style>
        /*@font-face {
            font-family: simplon;
            src: url({{ asset('fonts/simplon_regular.ttf') }});
        }*/
        body {
            /*font-family: simplon;*/
            margin: 0;
            padding: 0;
            width: {{ $size_width }}px;
            height: {{ $size_height }}px;
            overflow: hidden;
        }

        p {
            position: fixed;
            text-align: center;
            display: block;
        }

        img {
            width: {{ $size_width }}px;
            height: {{ $size_height }}px;
            margin: 0;
            padding: 0;
            position: fixed;
        }

        @foreach($data["properties"] as $prop)
            @if(!is_null($prop['text']))
                #{{ $prop['name'] }} {
                    top: {{ substr($prop['y_pos'], 0, -2) - 15 }}px;
                    left: {{ $prop['x_pos'] }};
                    width: {{ $prop['width'] }};
                    height: {{ $prop['height'] }};
                    font-size: {{ $prop['size'] }};
                    color: {{ $prop['color'] }};
                }
            @endif
        @endforeach

        @foreach($data["fields"] as $field)
            @if(!is_null($field['text']))
                #{{ $field['name'] }} {
                    top: {{ substr($field['y_pos'], 0, -2) - 15 }}px;
                    left: {{ $field['x_pos'] }};
                    width: {{ $field['width'] }};
                    height: {{ $field['height'] }};
                    font-size: {{ $field['size'] }};
                    color: {{ $field['color'] }};
                }
            @endif
        @endforeach

        #nada {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <img src="{{ $data['background_url'] }}" alt="">

    @foreach($data["properties"] as $prop)
        @if(!is_null($prop['text']))
            <p id="{{ $prop['name'] }}">{{ $prop['text'] }}</p>
        @endif
    @endforeach

    @foreach($data["fields"] as $field)
        @if(!is_null($field['text']))
            <p id="{{ $field['name'] }}">{{ $field['text'] }}</p>
        @endif
    @endforeach

    <p id="nada">nada</p>
</body>
</html>