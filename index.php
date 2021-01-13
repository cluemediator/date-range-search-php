<?php
// include database connection file
include('db_config.php');

$query = "SELECT * FROM orders ORDER BY order_number desc";  
$result = mysqli_query($con, $query);  
?>

<html>

<head>
  <title>Date range search with jQuery Datepicker using Ajax, PHP & MySQL - Clue Mediator</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
  <div class="container">
    <h4>Date range search with jQuery Datepicker using Ajax, PHP & MySQL - <a href="https://www.cluemediator.com/" target="_blank">Clue Mediator</a></h4>
    </br>
    <div class="row">
      <div class="col-md-2">
        <input type="text" name="from_date" id="from_date" class="form-control dateFilter" placeholder="From Date" />
      </div>
      <div class="col-md-2">
        <input type="text" name="to_date" id="to_date" class="form-control dateFilter" placeholder="To Date" />
      </div>
      <div class="col-md-2">
        <input type="button" name="search" id="btn_search" value="Search" class="btn btn-primary" />
      </div>
    </div>
    </br>
    <div class="row">
      <div class="col-md-8">
        <div id="purchase_order">
          <table class="table table-bordered">
            <tr>
              <th width="5%">Order Number</th>
              <th width="30%">Customer Name</th>
              <th width="40%">Item</th>
              <th width="15%">Price</th>
              <th width="10%">Purchased Date</th>
            </tr>
            <?php
            while($row = mysqli_fetch_array($result))  
            {  
            ?>  
              <tr>  
                  <td><?php echo $row["order_number"]; ?></td>  
                  <td><?php echo $row["customer_name"]; ?></td>  
                  <td><?php echo $row["purchased_items"]; ?></td>  
                  <td>$ <?php echo $row["price"]; ?></td>  
                  <td><?php echo $row["purchased_date"]; ?></td>  
              </tr>  
            <?php  
            }  
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {

      $('.dateFilter').datepicker({
        dateFormat: "yy-mm-dd"
      });

      $('#btn_search').click(function () {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
          $.ajax({
            url: "action.php",
            method: "POST",
            data: { from_date: from_date, to_date: to_date },
            success: function (data) {
              $('#purchase_order').html(data);
            }
          });
        }
        else {
          alert("Please Select the Date");
        }
      });
    });
  </script>
</body>

</html>