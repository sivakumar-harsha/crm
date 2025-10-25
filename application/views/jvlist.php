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
        <section class="content-header">
            <div class= "row">                                                            
                <div class="col-md-12">
                    <div class = "form-group col-md-2">
                        <label style="font-size: 18px;" >Journal List</label>
                    </div>
                    <div class = "form-group col-md-3">
                        <label>From Date</label>
                        <input type="date" class = "form-control" name = "fromdate" id="fromdate" value="<?=$today->format('Y-m-d')?>" style="width:65%;display:inline-block;"/>                     
                    </div>
            
                    <div class = "form-group col-md-3">
                        <label>To Date</label>
                        <input type="date" class="form-control inputs" name="todate" id="todate" value="<?=$today->format('Y-m-d')?>" style="width:65%;display:inline-block;">
                        &nbsp;&nbsp;
                        <button class = "btn btn-success btn-sm" id="search_btn" onclick="fetch_jvlist()"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>                                                                                                
                </div>
            </div>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border" style="background:#f4f4f48c;">
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body" _msthash="1196936" _msttexthash="1190501" style="text-align: left;">
                    
                    <div class="row">
                        <div class="col-md-12"><div id="table_view"></div></div>
                    </div>          
                          
                </div>  
            </div>
        
        </section>
    </div>    
  
  <script>
  
    
    
  
    $(document).ready(function(){                       
        fetch_jvlist();        
    });
    
    
    
    
      function fetch_jvlist(fromdate, todate)
      {
            var fromdate = $("#fromdate").val();
            var todate = $("#todate").val();

            $.ajax({
              url:"fetch_jvlist",
              data:{fromdate: fromdate, todate: todate },
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