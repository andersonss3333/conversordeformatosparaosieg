@include('layoutBase.cabecalho')

    <body>
        <hr />

        <h3 class='text-center'> Conversor para o padrão de importação do Sistema Sieg</h3>

        <hr />

        <form action='/salvador' method='post' enctype='multipart/form-data' id='uploadfile'>
        @csrf

        <div class='row mb-3'>
           <label for='arquivosalvador' class='col-sm-2 col-form-label'> Converta seu arquivo texto de Salvador </label>
        <div class='col-sm-6'>
           <input name='arquivosalvador' type='file' id='arquivosalvador' class='form-control form-control-sm' aria-describedby='aviso' />
@error('arquivosalvador') 
           <span class='text-danger'> {{ $message }} </span>
@enderror
           <div id='aviso' class='form-text'>Somente arquivo do tipo .txt </div>
        </div>
        </div>
        </div>

           <button class='btn btn-sm' type='submit' id='arquivotextobutton' >Converter Arquivo </button>

        </form>

    </body>

</html>