<?php
error_reporting(E_ALL & ~E_NOTICE); // isso é errado eu to ignorando aquele notice chato ele não quebra o codigo mas pode ocultar informações relevantes 
// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'uploads/';
 
// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
 
// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'png', 'gif');
 
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = true;


//pega o nome atual do arquivo Nome atual 
$nome_atual = $_FILES['arquivo']['name'];

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
die("Não foi possível fazer o upload, erro:<br />" . $_UP['error'][$_FILES['arquivo']['error']]);
exit; // Para a execução do script
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
}

 
// Faz a verificação do tamanho do arquivo
else 
if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
}
 
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com a mesma extensão
$nome_final = time().".$extensao";
} else {
// Mantém o nome original do arquivo
$nome_final = $_FILES['arquivo']['name'];
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
echo "Upload efetuado com sucesso!";
$diretorio = $_UP['pasta'] . $nome_final ;
//echo "<br /><a href= $diretorio >Clique aqui para acessar o arquivo</a>";

} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Não foi possível enviar o arquivo, tente novamente";
}
 
}
 
//
require_once("model/arquivo_dao.php");
$arquivo->adicionar_imagem($nome_atual,$diretorio);
?>
