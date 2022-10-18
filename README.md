# Desafio 7 Days of Code - PHP

## Desafio 1
    > Criação dos arquivos **controller.php** e **view.php**, similar ao **MVC**. 
    
    Esses dois novos arquivos farão o trabalho que hoje é feito por route.php.

    Criar as funções **do_register()**, **do_login()** e **do_not_found()** no arquivo **controller.php**. 
    
    Já no arquivo view.php, você criará a função **render_view($template)**.
    
    No arquivo routes.php, em vez de carregar o template da resposta, você chamará a função de **controller.php** de acordo com o parâmetro *GET ?page=value*
    
    Já o **controller.php** usará a função do arquivo **view.php** para renderizar o conteúdo da resposta.

## Desafio 2
    > Você criará o arquivo crud.php e a função crud_create($user) para salvar os dados enviados pelo usuário no formulário de registro.

    Você não usará banco de dados. A função crud_create($user) deverá ler o conteúdo do arquivo /data/users.json, acrescentar um novo elemento ao array e atualizar o conteúdo do arquivo users.json.

    Para a etapa da persistência, você poderá usar as funções file_get_contents, file_put_contents, json_encode e json_decode.

    Quando chegar uma requisição POST do formulário de registro, você deverá chamar a função que salva os dados e redirecionar para a url /?page=login usando a função header(), se houver alguma informação no array $_POST.

    Quando chegar uma requisição GET à URL /?page=register, a mesma do formulário de registro, você deverá mostrar o formulário presente no template ‘register’.