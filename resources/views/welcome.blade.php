@include('layoutBase.cabecalho')

    <body>
        <hr />

        <h3> Conversor para o padrão de arquivos de texto para o Sitema Sieg</h3>

        <hr />

        <form action='/salvador' method='post' enctype='multipart/form-data' id='uploadfile'>
        @csrf

           <input name='arquivosalvador' type='file' id='arquivosalvador' /> <br />

@error('arquivosalvador') 
   <span> {{ $message }} </span>

@enderror
           <button type='submit' id='arquivotextobutton' >Converter Arquivo Salvador </button>

        </form>

    </body>

</html>