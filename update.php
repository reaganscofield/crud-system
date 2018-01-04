
<?php
    //bring class CrudOperation fille
    //this files contents the logic of application
    include("app/CrudOperation.php");
?>
  <div class="container">

      <?php
          include("layouts/header.php");
      ?>
<main role="main">

  <?php
    include("layouts/jumbo.php");
  ?>

  <?php

      //getting single message from Objects Class
      if(isset($_GET['Update'])){
        $getId = $_GET['Update'];
        $where = array("id" => $getId);
        $rows = $Objects->selectSingleRecord("crud", $where);
      }

   ?>

 <div class="container">
   <div class="mt-3">
     <div class="w-75 p-3 mx-auto">
       <div id="this" class="card" >
        <h5 class="card-header bg-success text-center">Add Message</h5>
        <div class="card-body">
          <div class="w-75 p-3 mx-auto">
            <form method="POST" action="index.php" >
              <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
               <div class="form-group">
                 <label>Message</label>
                 <textarea name="message" id="this" class="form-control" rows="3" required><?php echo $rows['message']; ?></textarea>
                 <button name="update" type="submit" class="btn btn-success mt-2">Save Change</button>
               </div>
            </form>
          </div>
        </div>
      </div>
     </div>
   </div>
  </div>
</main>
      <?php
          include("layouts/footer.php");
      ?>
  </div>
