
<div class="container">

  <div class="col-sm-offset-3 col-sm-6">

    <form class="form-inline" action="./token_validator.php" method="POST">
        <label style="color: white; font-size: 18px">Ingresa tu token: </label>
      <div class="form-group">
        <label class="sr-only" for="token">Canjeo del token</label>
        <div class="input-group">
          <input type="text" class="form-control" id="token" name="token" placeholder="">
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="font-size: 18px">Registrar token</button>
    </form>
    

    <div align="center">
      <a href="./main.php">
        <button class="btn btn-info">Regresar</button>
      </a>
    </div>
  </div>

</div>
