<?php
if($_SESSION['logado'] && $_SESSION['sts_usuario'] && $_SESSION['per_usuario']) {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      require_once 'config.php';

      $conn = new mysqli($host, $user, $password, $dbname);
      
      if($conn->connect_error){
        die("Erro de conexão: ".$conn->connect_error);
      }
      else {
        $nom_empresa = mysqli_real_escape_string($conn, $_POST['nom_empresa']);
        $dti_emprego = date('Y-m-d', strtotime($_POST['dti_emprego']));
        $dtt_emprego = date('Y-m-d', strtotime($_POST['dtt_emprego']));
        $id_atleta = mysqli_real_escape_string($conn, $_POST['id_atleta']);

        $sql = "insert into empregos (
          nom_empresa, 
          dti_emprego, 
          dtt_emprego, 
          id_atleta) 
          values (
          '$nom_empresa', 
          '$dti_emprego', 
          '$dtt_emprego', 
          '$id_atleta')";

        if($conn->query($sql) === TRUE) {
          ?>
          <br>
          <div class="alert alert-success" role="alert">
            <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>  
            Emprego criado com sucesso!</h2>
            clique no botão abaixo para atualizar a página e ver os resultados.
            </div>
            <?php
            echo "<td><a href='main.php?p=empregos/index.php' class='btn btn-secondary'>Atualizar</a></tr>";
        }
        else {
          ?>
          <div class="alert alert-danger" role="alert">
            <?php
            echo "Falha: ".$sql."\n".$conn->error;
            ?>
          </div>
          <?php
        }
      }
    }
    if(!isset($_POST["enviar"])) {
  ?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Novo emprego</h1>
  </div>
  <form class="body row" action="main.php?p=empregos/new.php" method="post">
    <div class="col-md-5 mb-3">
      <label for="nom_empresa" class="form-label">Nome da empresa</label>
      <input type="text" required="" class="form-control" id="nom_empresa" name="nom_empresa" maxlength="40">
    </div>
    <div class="col-md-3 mb-3">
      <label for="dti_emprego" class="form-label">Data de inicio</label>
          <input type="date" required="" class="form-control" id="dti_emprego" name="dti_emprego">
    </div>
    <div class="col-md-3 mb-3">
      <label for="dtt_emprego" class="form-label">Data de término</label>
          <input type="date" class="form-control" id="dtt_emprego" name="dtt_emprego">
    </div>
    <div class="col-md-1 mb-3">
      <label for="id_atleta" class="form-label">ID do atleta</label>
      <input type="text" required="" class="form-control" id="id_atleta" name="id_atleta" maxlength="6">
    </div>
    <div class="col-md-6 mb-3">
    <button type="submit" class="btn btn-success" name="enviar">Cadastrar</button>
    <a class="btn btn-secondary" href="main.php?p=empregos/index.php" role="button">Voltar</a>
    </div>
  </form>

<?php
  }
}
else {
  ?>
  <br>
  <div class="alert alert-danger" role="alert">
      <h2>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
          <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </svg>
      Acesso negado!</h2>
      clique no botão abaixo para voltar.
  </div>
  <?php
  echo "<td><a href='main.php?p=empregos/index.php' class='btn btn-secondary'>Área de login</a></tr>";
}
?>