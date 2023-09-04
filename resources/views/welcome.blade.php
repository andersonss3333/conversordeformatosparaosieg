@include('layoutBase.cabecalho')

    <body>
        <hr />

        <h3> Conversor para o padrão de arquivos de texto para o Sitema Sieg</h3>

        <hr />

        <form action='/salvador' method='post' enctype='multipart/form-data' id='uploadfile'>
        @csrf

           <label for='arquivosalvador'> Converta seu arquivo texto de Salvador </label> <br /> <br />

           <input name='arquivosalvador' type='file' id='arquivosalvador' /> <br />

           <button type='submit' id='arquivotextobutton' >Converter Arquivo Salvador </button>

@error('arquivosalvador') 
           <span> {{ $message }} </span>
@enderror

        </form>

    </body>

</html>