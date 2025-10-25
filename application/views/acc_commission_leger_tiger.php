   <!-- Content Wrapper. Contains page content -->
  
  <style>
      label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset !important;
}
  </style>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Commission Mismatching List
        
         <div class="row">
             <div class="col-md-3">
             </div>
             <div class="col-md-3">
                 <div class="form-group"> 
                 <label>From Date</label>
                     <input type="date" class="form-control" name="from_date" id="from_date" value ="<?php echo date("Y-m-01") ?>">
                 </div>
             </div>
              <div class="col-md-3">
                 <div class="form-group">
                     <label>To Date</label>
                     <input type="date" class="form-control" name="to_date" id="to_date" value ="<?php echo date("Y-m-t")  ?>">
                 </div>
             </div>
              <div class="col-md-3">
                  <br>
                 <button class="btn btn-primary" id="sub_btn">Submit</button>
             </div>
             <div id="result"></div>
         </div>
      </h1>
    </section>
</div>




 <script>
    
      var from_date = $("#from_date").val();
       var to_date  = $("#to_date").val();
             
     $(document).ready(function(){
        // get_active_policy_commission_leg(from_date,to_date);
         
         $("#sub_btn").click(function(){
             var from_date = $("#from_date").val();
             var to_date  = $("#to_date").val();
             get_active_policy_commission_leg(from_date,to_date);
         });
         
    });
    
    function get_active_policy_commission_leg(from_date,to_date)
    {
      $.ajax({
        url:"get_active_policy_commission_leg",
        data:{from_date:from_date,to_date:to_date},
        method:"POST",
        success:function(response){
          //var obj = jQuery.parseJSON(response);
            $('#result').html(response);
          },
          error: function(code) {   
            alert(code.statusText);
          },
        });
      }
    
    </script>
        