<?php
  include('connection.php');

  $ID = $_POST['ID'];
  $query = "SELECT * FROM winelist_".$_COOKIE['username']." WHERE ID='".$ID."';";
  $result = mysqli_query($link, $query);

  if($row = mysqli_fetch_array($result)){
      echo '<form id="updateWineForm" method="POST">
        <input name="id" value="'.$ID.'" hidden />
        <div class="form-group">
          <label for="name">Name: </label>
          <input class="form-control" placeholder="Name" type="text" name="name" value="'.$row['Name'].'"/>
        </div>
        <div class="form-group">
          <label for="varietal">Varietal: </label>
          <input class="form-control" placeholder="Varietal" type="text" name="varietal" value="'.$row['Varietal'].'"/>
        </div>
        <div class="form-group">
          <label for="vintage">Vintage: </label>
          <input class="form-control" placeholder="Vintage" type="text" name="vintage" value="'.$row['Vintage'].'"/>
        </div>
        <div class="form-group">
          <label for="appellation">Appellation: </label>
          <input class="form-control" placeholder="Appellation" type="text" name="appellation" value="'.$row['Appellation'].'"/>
        </div>
        <div class="form-group">
          <label for="region">Region: </label>
          <input class="form-control" placeholder="Region" type="text" name="region" value="'.$row['Region'].'"/>
        </div>
        <div class="form-group">
          <label for="imageurl">Image URL: </label>
          <input class="form-control" placeholder="Imageurl" type="text" name="imageurl" value="'.$row['Imgurl'].'"/>
        </div>
        <div class="form-group">
          <label for="cost">Cost: </label>
          <input class="form-control" placeholder="Cost" type="number" name="cost" value="'.number_format($row['Cost'],2).' "step="any"/>
        </div>
        <div class="form-group">
          <label for="price">Price: </label>
          <input class="form-control" placeholder="Price" type="number" name="price" value="'.number_format($row['Price'],2).'" step="any"/>
        </div>
        <div class="form-group">
          <label for="inventory">Inventory: </label>
          <input class="form-control" placeholder="Inventory" type="number" name="inventory" value="'.number_format($row['Inventory'],1).'" step="any"/>
        </div>
        <div class="form-group">
          <label for="size">Size: </label>
          <select class="form-control" placeholder="Size" type="number" name="size">
            <option value="'.$row['Size'].'" selected>'.$row['Size'].'</option>
            <option value="187 mL">187 mL</option>
            <option value="375 mL">375 mL</option>
            <option value="750 mL">750 mL</option>
            <option value="1.5 L">1.5 L</option>
            <option value="3.0 L">3.0 L</option>
          </select>
        </div>
        <div class="form-group">
          <label for="tastingnotes">Tasting Notes: </label>
          <input class="form-control" placeholder="Tasting Notes" type="text" name="tastingnotes" value="'.$row['Tastingnotes'].'"/>
        </div>
        <div class="form-group">
          <label for="wineryinfo">Winery Information: </label>
          <input class="form-control" placeholder="Winery Information" type="text" name="wineryinfo" value="'.$row['Wineryinfo'].'"/>
        </div>
          <input class="btn btn-danger" type="submit" name="submit" value="Update Wine"  />
      </form>';
  }

 ?>
