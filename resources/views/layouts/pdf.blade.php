<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            border-collapse: collapse;
            border-color: #000;
            border-style: solid;
            text-align: center;
        }
        table tr th, table tr td{
            padding: 10px;
        }
        table thead{
            color: #fff;
            background-color: black;
        }
        .pdf-header{
            color: #000;
            background-color: #ffd000;
        }
        .pdf-header .pdf-header-title{
            height: auto;
            display: flex;
            align-items: center;
        }
        .pdf-header-title .title-tag{
            padding: 10px 8px;
            color: #ffd000;
            background-color: #000;
        }
        .p-desc{
            color: #666;
        }
        .main-content .content-title{
            text-decoration: underline;
        }
        .main-footer{
            padding: 0;
            margin-top: 20px;
            color: #aaa;
            text-align: center;
            border-top: 1px dashed currentColor;
        }
    </style>

    @yield('style')

    <title> @yield('title') </title>
</head>
<body>
    <header class="pdf-header">
        <h1 class="pdf-header-title">
            <span class="title-tag">Nossa</span><span>Loja</span>
        </h1>
    </header>

   <main class="main-content">
        <h2 class="content-title"> @yield('title') </h2>
        
        @yield('description') 

        @yield('content')
   </main>


   <footer class="main-footer">
        <p>
            <small>
                <i>
                    Nossa loja - Todos os direitos reservados <br>
                    Arquivo emitido em: {{ date('d-m-Y H:i') }}
                </i>
            </small>
        </p>
   </footer>
</body>
</html>