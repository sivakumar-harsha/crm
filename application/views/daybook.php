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
      <div class = "row">                     
            <div class = "col-md-3">
                <label>Date</label>
                <div class = "form-group">                  
                  <input class = "form-control select2" name = "date" id="date" type="date" style="width:65%;display:inline-block;" value="<?=$today->format('Y-m-d')?>">
                  &nbsp;&nbsp;
                  <button class = "btn btn-success btn-sm" id="search_btn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
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
  
    var date = $("#date").val();
    
  
    $(document).ready(function(){
                       
         acc_ledger(date)
                            
         $("#search_btn").click(function(){
            var date = $("#date").val();
            acc_ledger(date)
         });
    });
    
    
    
    
      function acc_ledger(date)
      {
          
            $.ajax({
              url:"fetch_daybook",
              data:{date: date},
              method:"POST",
              beforeSend: function() {
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
        
   function export_excel(date)
   {
        $.ajax({
              url:"export_daybook",
              data:{date:date},
              method:"POST",
              beforeSend:function()
                 {
                     $("#export_btn").attr("disabled",true);
                 },
                 success:function(response)
                 {
                     $("#export_btn").attr("disabled",false);
                     window.location.href=response;
                 }
            }); 
    }
        
        
        
 </script>