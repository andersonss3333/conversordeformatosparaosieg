@include('layoutBase.cabecalho')

    <body>
        <hr />

        <h3 class='text-center'> Conversor para o padrão de importação do Sistema Sieg</h3>

        <hr />

        <form action='/salvador' method='post' enctype='multipart/form-data' id='uploadfile'>
        @csrf

        <div class='mb-3'>
           <label for='arquivosalvador' class='form-label'> Converta seu arquivo texto de Salvador </label>
           <input name='arquivosalvador' type='file' id='arquivosalvador' class='form-control form-control-sm' aria-describedby='aviso' />
           <div id='aviso' class='form-text'>Somente arquivo do tipo .txt </div>
        </div>

           <button class='btn btn-sm' type='submit' id='arquivotextobutton' >Converter Arquivo </button>

@error('arquivosalvador') 
           <span class='text-danger'> {{ $message }} </span>
@enderror

        </form>

    </body>

</html>