
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

 <div class="container">
   <div class="mt-3">
     <div class="w-75 p-3 mx-auto">
       <div id="this" class="card" >
        <h5 class="card-header bg-success text-center">Add Message</h5>
        <div class="card-body">
          <div class="w-75 p-3 mx-auto">
            <form method="POST" action="index.php">
               <div class="form-group">
                 <label for="exampleFormControlTextarea1">Message</label>
                 <textarea name="message" id="this" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                 <button name="submit" type="submit" class="btn btn-success mt-2">Submit</button>
               </div>
            </form>
              <!-- Outputting error Validation error message -->
              <?php echo $thisMessage; ?>
          </div>
        </div>
      </div>



       <div class="mt-3">
         <table class="table table-bordered text-center table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Message</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <?php
                //getting all messages from Objects and Loop trough it
                $myData = $Objects->fetchRecord("crud");
                foreach($myData as $thisRef) {

            ?>
            <tbody>
              <tr>
                <th scope="row"><?php echo $thisRef['id'] ?></th>
                <td><?php echo $thisRef['message'] ?></td>
                <td><a class="btn btn-sm btn-success" href="update.php?Update=<?php  echo $thisRef['id']?>">Edit</a></td>
                <td><a class="btn btn-sm btn-danger" href="index.php?Delete=<?php  echo $thisRef['id']?>">Delete</a></td>
              </tr>
            </tbody>
          <?php } ?> <!-- Ending foreach loop -->
          </table>
       </div>
     </div>
   </div>
  </div>
</main>

      <?php
          include("layouts/footer.php");
      ?>
  </div>
