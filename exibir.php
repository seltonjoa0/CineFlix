<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine_pirata";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ID do filme que você quer buscar
$filme_id = 1; // Altere para o ID do filme desejado

// Consultar o filme
$sql = "SELECT titulo, sinopse, poster_url, iframe_url FROM filmes WHERE id = $filme_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Recuperar os dados do filme
    $filme = $result->fetch_assoc();
} else {
    echo "Filme não encontrado.";
}

$conn->close();
?>

<div class="conteudo-1">
    <div class="esquerda">
        <img class="imagem-esquerda" src="<?php echo $filme['poster_url']; ?>" alt="titulo <?php echo $filme['titulo']; ?>" width="500px" style="height: 150px; width: 400px; margin-bottom: 50px;">
        <p class="descricao"><?php echo $filme['sinopse']; ?></p>
        <div class="btn-filme-1">
            <button class="btn-destaque" id="btn-play"><svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px" fill="#000000"><path d="M320-202v-560l440 280-440 280Z"/></svg><span>Assistir</span></button>
            <button class="btn-destaque" id="btn-info"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#FFFFFF"><path d="M448.67-280h66.66v-240h-66.66v240Zm31.32-316q15.01 0 25.18-9.97 10.16-9.96 10.16-24.7 0-15.3-10.15-25.65-10.16-10.35-25.17-10.35-15.01 0-25.18 10.35-10.16 10.35-10.16 25.65 0 14.74 10.15 24.7 10.16 9.97 25.17 9.97Zm.19 516q-82.83 0-155.67-31.5-72.84-31.5-127.18-85.83Q143-251.67 111.5-324.56T80-480.33q0-82.88 31.5-155.78Q143-709 197.33-763q54.34-54 127.23-85.5T480.33-880q82.88 0 155.78 31.5Q709-817 763-763t85.5 127Q880-563 880-480.18q0 82.83-31.5 155.67Q817-251.67 763-197.46q-54 54.21-127 85.84Q563-80 480.18-80Zm.15-66.67q139 0 236-97.33t97-236.33q0-139-96.87-236-96.88-97-236.46-97-138.67 0-236 96.87-97.33 96.88-97.33 236.46 0 138.67 97.33 236 97.33 97.33 236.33 97.33ZM480-480Z"/></svg>Mais informações</button>
            <div id="floatingMessage" class="hidden"><?php echo $filme['sinopse']; ?></div>
        </div>
        <div class="player">
            <?php echo $filme['iframe_url']; ?> <!-- Aqui você insere o iframe -->
        </div>
    </div>
</div>
