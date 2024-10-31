<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "cine_pirata";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Sua chave da API do TMDB
$api_key = "fe153885e303bf5c8a55cdf39dad43ae";

// Definir os gêneros e seus respectivos IDs no TMDB
$generos = [
    "Ação" => 28,
    "Comédia" => 35,
    "Romance" => 10749,
    "Terror" => 27,
    "Documentário" => 99
];

// Função para inserir gêneros no banco, caso ainda não existam
function inserir_genero($conn, $nome, $id_tmdb) {
    $sql = "INSERT IGNORE INTO generos (id, nome) VALUES ($id_tmdb, '$nome')";
    $conn->query($sql);
}

// Função para buscar filmes e associar aos gêneros
function buscar_e_armazenar_filmes($conn, $api_key, $genero_nome = null, $genero_id = null) {
    $url = "https://api.themoviedb.org/3/discover/movie?api_key=$api_key&language=pt-BR&sort_by=popularity.desc&vote_count.gte=1000&";
    if ($genero_id) {
        $url .= "with_genres=$genero_id";
    }

    $response = file_get_contents($url);
    if ($response === FALSE) {
        die("Erro ao fazer a requisição para a API do TMDB.");
    }

    $dados = json_decode($response, true);
    $filmes = $dados['results'];

    // Inserir cada filme e associar aos gêneros
    foreach ($filmes as $filme) {
        $titulo = $conn->real_escape_string($filme['title']);
        $sinopse = $conn->real_escape_string($filme['overview']);
        $data_lancamento = $filme['release_date'];
        $duracao = isset($filme['runtime']) ? $filme['runtime'] : null;
        $poster_url = "https://image.tmdb.org/t/p/w500" . $filme['poster_path'];

        // Inserir o filme na tabela filmes
        $sql_filme = "INSERT INTO filmes (titulo, sinopse, data_lancamento, duracao, poster_url)
                      VALUES ('$titulo', '$sinopse', '$data_lancamento', '$duracao', '$poster_url')";
        $conn->query($sql_filme);
        $filme_id = $conn->insert_id;

        // Associar filme ao gênero
        if ($genero_id) {
            $sql_associacao = "INSERT INTO filme_genero (filme_id, genero_id) VALUES ($filme_id, $genero_id)";
            $conn->query($sql_associacao);
        }
    }
}

// Inserir os gêneros no banco e buscar filmes para cada um
foreach ($generos as $nome_genero => $id_genero) {
    inserir_genero($conn, $nome_genero, $id_genero);
    buscar_e_armazenar_filmes($conn, $api_key, $nome_genero, $id_genero);
}

// Buscar e armazenar os 20 filmes em alta, sem filtro de gênero
buscar_e_armazenar_filmes($conn, $api_key);

$conn->close();
?>
