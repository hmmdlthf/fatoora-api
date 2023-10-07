
<table class='table table-striped' id='myTable'>
    <thead>
       <tr>
          <th scope='col'>ID</th>
        
          <th scope='col'>UPC</th>
          <th scope='col'>Item Number</th>
          <th scope='col'>Product Name</th>
          <th scope='col'>Unit Measure</th>
          <th scope='col'>اسم المنتج</th>
          <th scope='col'>وحدة قياس </th>
          <th scope='col'>سعر التجزئة </th>
          <th scope='col'>سعر بالجملة </th>
           <th scope='col'>Stock</th>
          <th scope='col'>Sub</th>
          <th scope='col'>Action</th>
       </tr>
    </thead>
    </table>

    <script src="js/jquery.dataTables.min.js"></script>

<!-- Add the SubstituteButtonFunction here -->
<script>
    function SubstituteButtonFunction() {
        $.ajax({
            url: 'get_inventory_data_sub.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Assuming data is the new dataset you want to display
                $('#myTable').DataTable().clear().rows.add(data).draw();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX call failed: " + textStatus + ", " + errorThrown);
            }
        });
    }


    $(document).ready( function () {
        $('#myTable').DataTable( {
            "retrieve": true,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 100,
            "ajax": "get_inventory_data.php"
        } );

        $("#inventory-dismiss").click(function(){
            location.reload();
        });
    });
</script>