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

    Quando chegar uma requisição POST do formulário de registro, você deverá chamar a função que salva os dados e redirecionar para a url /?page=login usando a função header(), se houver alguma informação no array $_POST.

    Quando chegar uma requisição GET à URL /?page=register, a mesma do formulário de registro, você deverá mostrar o formulário presente no template ‘register’.


## Desafio 3
    > Validar os dados do usuário e, caso haja algum erro no formulário, a requisição deverá retroceder para a tela anterior. Uma mensagem de erro deverá ser exibida na tela APENAS quando um erro acontecer.

    Os dados precisam ser avaliados da seguinte forma:

       1. Não deve haver mais de um registro por e-mail;
       2. A senha deve ter mais de 10 caracteres e ser igual ao campo de validação.          

    A equipe responsável pelo front-end já deixou o layout pronto com mensagens de sucesso e erro fixas no sistema, e isso deve aparecer apenas no momento certo! Atualmente, essas mensagens aparecem sempre e em todas as telas. Você deverá modificar esse comportamento e só exibi-las quando precisar informar algo ao usuário.

    Caso o usuário tenha êxito no cadastro, haverá redirecionamento para a tela de login, onde uma mensagem de sucesso irá informar que ele ainda precisa confirmar o e-mail.

    Um caminho válido seria criar uma função no arquivo crud.php, que recebe um e-mail como parâmetro e, caso encontre um valor, retorne um array ou objeto correspondente; e caso não encontre, retorne false.

    A validação irá exigir um novo arquivo focado nisso, então você pode criar o validation.php. Cada requisição que demande validação de formulário deverá ter uma função correspondente neste novo arquivo!


## Desafio 4
    > Acrescentar um campo para salvar o usuário recém-criado, uma flag com valor padrão. Após o clique no link do e-mail, essa flag será alterada e, somente após isso, o usuário poderá logar no sistema.

    Ao criar um registro, deverá ser enviado um e-mail para o usuário cadastrado, com o link de validação de conta de e-mail


## Desafio 5
    > Fazer:
       1. O tratamento do token de validação do e-mail
       2. Ativar ou não a conta, caso o token seja ou não válido;
       3. Redirecionar para a tela de login onde uma mensagem de erro ou sucesso será exibida.
       4. Criar o login. Crie o arquivo auth.php


## Desafio 6    
    > Gerar a página inicial dinamicamente com os dados do usuário logado, desenvolver a funcionalidade de deletar os dados e ativar o botão de logout!
       

## Desafio 7
    > Gerar o fluxo de alterar senha.

    Quando um usuário clicar em "Esqueci Minha Senha" você receberá uma requisição GET em forget-password. Você sabe qual método HTTP foi usado na requisição com consultando $_SERVER['REQUEST_METHOD'].

    Se chegar um POST, significa que o usuário submeteu o formulário e duas situações diferentes podem acontecer. Para identificar qual, use a função crud_restore($email) (eu não estava brincando quando disse que estava tudo pronto):

        1.  Situação 1 - O email informado existe na base: Envie um email para o usuário. 
            Concatenar a data de hoje com o email do usuário, pois é interessante que esse link tenha um prazo de expiração. Faça um BASE64 dessa string, e só então invoque a função que encripta a informação. Passe uma mensagem de sucesso e renderize a view referente à rota, exibindo a informação que você passou!
        2.  Situação 2 - O email informado não existe na base: Passar uma mensagem de erro e renderize a view referente à rota, exibindo a informação que você passou!
            Quando o usuário clicar no link que você enviou por email, irá disparar uma requisição para a outra rota que você criou no desafio de hoje: change-password.
            
            Se for GET, valide o token; caso esteja ok, exiba a view change_password, e não esqueça de injetar o token num input hidden no formulário, pois você irá precisar dessa informação quando o usuário submeter o form. Caso o token falhe, apenas redirecione para / e, se achar pertinente, exiba uma mensagem descrevendo qual erro ocorreu, se o token está corrompido ou expirado, por exemplo.

            Se chegar uma requisição POST - após validar a integridade do token - valide se a senha atende ao critério mínimo que você especificou em /?page=register. Para isso, crie a função validate_change_password($data) no arquivo validation.php.

            Caso haja problema com a integridade do token, faça o mesmo que fez quando tratou a requisição GET. Caso haja problema com o critério mínimo para a senha, exiba novamente a view change_password, exibindo uma mensagem alertando o que ocorreu, e não esqueça de enviar o token novamente para preencher o input:hidden!

            Caso as validações não acusem nenhum erro, use a função crud_restore($email) passando o email encapsulado no token. Atribua o valor da senha nova no campo password, não se esqueça de aplicar MD5 antes de devolver o objeto $user para a função crud_update($user).

    Caso tudo dê certo, redirecione o usuário para /?page=login e exiba uma mensagem informando que deu tudo certo.



    

    
