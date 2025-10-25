<style>
 
 .form-control {
    display: block;
    width: 100%;
    height: 29px;
    padding: 4px 10px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

  label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: unset;
    font-size: 14px;
}
@media (min-width: 992px) {
    .col-md-2 {
        width: 14.66666667%;
        padding-left:10px; padding-right: 10px;
    }
}
@media (min-width: 992px) {}
    .col-md-3 {
        width: 32%;        
        padding-left:5px; padding-right: 5px;
    }
}

    </style>

 <!-- Content Wrapper. Contains page content -->
 <?php $today = new DateTime();?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h4 align='center' style='font-weight: bold'>Trial Balance</h4>
      <div class = "row">            
          <div class = "col-md-3">
              <div class = "form-group">
                  <label>From Date</label>
                  <input type = "date" class="form-control" id="fromdate" name="fromdate" value="<?=$today->format('Y-m-d')?>">  
              </div>
          </div>
          
          <div class = "col-md-3">
          <label>To Date</label>
              <div class = "form-group">                  
                  <input type = "date" class="form-control" id="todate" name="todate" style="width:65%;display:inline-block;" value="<?=$today->format('Y-m-d')?>">  
                  &nbsp;&nbsp;
                  <button class = "btn btn-success btn-sm" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>                                         
              </div>              
          </div>
          <div class='pull-right col-md-3 hide' id="showbtn">
          <label>&nbsp;</label>
              <div class = "form-group">
                <input type='button' value='Profit / Lose' class='btn btn-primary' style="display:inline-block;" onclick="export_profitlose()">
                &nbsp;&nbsp;
                <input type='button' value='Balance Sheet' class='btn btn-info' onclick="export_balancesheet()">
              </div>
          </div>                     
      </div>
      
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
        </div>       
      </div>
    </section>
  </div>
  
  
  
  <script>
            
    $(document).ready(function(){
                       
         trialbalance()
                            
         $("#search_btn").click(function(){            
          trialbalance()
         });
    });
                
    function trialbalance()
    {
      var fromdate = $("#fromdate").val();
      var todate = $("#todate").val();

      $.ajax({
        url:"fetch_trialbalance",
        data:{
          fromdate: fromdate, todate: todate
        },
        method:"POST",
        beforeSend: function() {
          $('#showbtn').addClass('hide');
          $("#table_view").html('Loading...');
        },
        success:function(response){
          $("#table_view").html(response);
          
        },
        error: function(code) {
          alert(code.statusText);
        },
      });
    }
        
   function export_profitlose()
   {
      var fromdate = $("#fromdate").val();
      var todate = $("#todate").val();
      window.open("profitlose?fromdate="+fromdate+"&todate="+todate,"blank");            
    }

   function export_balancesheet()
   {
      var fromdate = $("#fromdate").val();
      var todate = $("#todate").val();
      window.open("balancesheet?fromdate="+fromdate+"&todate="+todate,"blank");    
    }
        
        
        
 </script>