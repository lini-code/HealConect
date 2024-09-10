<?php
// Configuração do banco de dados
$servername = "localhost";  // Normalmente "localhost"
$username = "root";         // Usuário do banco de dados
$password = "";             // Senha do banco de dados
$dbname = "healconect";     // Nome do banco de dados

// Conectar ao banco de dados


// Verificar a conexão
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
  } catch (\Throwable $th) {
    throw $th;
  }

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];
    
    // Captura dos dias de atendimento selecionados
    $dias_atendimento = [];
    if (isset($_POST['segunda'])) $dias_atendimento[] = 'Segunda';
    if (isset($_POST['terca'])) $dias_atendimento[] = 'Terça';
    if (isset($_POST['quarta'])) $dias_atendimento[] = 'Quarta';
    if (isset($_POST['quinta'])) $dias_atendimento[] = 'Quinta';
    if (isset($_POST['sexta'])) $dias_atendimento[] = 'Sexta';
    if (isset($_POST['sabado'])) $dias_atendimento[] = 'Sábado';
    if (isset($_POST['domingo'])) $dias_atendimento[] = 'Domingo';

    // Converter array de dias para string separada por vírgulas
    $dias_atendimento_str = implode(', ', $dias_atendimento);

    // Inserir dados na tabela
    $sql = "INSERT INTO medicos (nome, especialidade, dias_atendimento) VALUES ('$nome', '$especialidade', '$dias_atendimento_str')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo médico adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>