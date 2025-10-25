<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

  .form-control {
    display: block;
    width: 100%;
    height: 31px;
    padding: 4px 11px;
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

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;
    border: 1px solid #fff;
    border-radius: 4px;
    cursor: default;
    color: #fff;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px;
}

.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}

.txt-red {
    color: red;
}

.highlight {
    background-color: yellow;
}

</style>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.extend({
            treed: function (o) {
            
            var openedClass = 'glyphicon-minus-sign';
            var closedClass = 'glyphicon-plus-sign';
            
            if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                closedClass = o.closedClass;
                }
            };
            
                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });

                //fire event from the dynamically added icon
                tree.find('.branch .indicator').each(function(){
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });

                // Auto-expand tree nodes
                this.find('li:has(ul)').addClass('expanded');
                this.find('li.expanded > i').removeClass(closedClass).addClass(openedClass);
                this.find('li.branch > ul').show();
                
                
                tree.on('click', '.node-value', function() {
                    var nodeValue = $(this).text();
                    //$('#nodeValue').text(nodeValue);
                    //$('#nodeModal').modal('show');
                    edit_apply_forms(nodeValue);
                });

                // tree.find('.branch').each(function() {
                //     var icon = $(this).children('i:first');
                //     icon.removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
                //     $(this).children().children().show();
                // });
            }
        });

        $('#tree').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});
               

    });

    


</script>
 


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="font-size: 17px;">
        Account Tree
        <button data-toggle="modal" data-target="#add_model" class="btn btn-primary btn-sm pull-right">Add New</button>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <div id="table_view"></div>
            
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 10px;">
                    <div class="controls">
                        <!-- <input type="text" id="searchInput" placeholder="Search for a node">
                        <button id="searchButton">Search and Highlight</button> -->

                        <button id="openAllNodesButton" type="button">Expanded</button>&nbsp;&nbsp;                                                
                        <button id="closeAllNodesButton" type="button" >Collepsed</button>
                    </div>
                </div>
            
                <div class="col-md-4" style="height:100vh;overflow: scroll">
                    <?=$treeHTML?>
                </div>
                <div class="col-md-6">
                    <div id="edit_forms"></div>
                </div>
            </div>
        </div><!-- /.box-body -->        
      </div><!-- /.box -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
  
  
   <div class="modal fade in" id="add_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Account Tree</h4>
            </div>
            <div class="modal-body">
                
                 <div class="form-group">
                      <label>Main Ledger</label>
                      <select class="form-control select2" name="add_main_ledger" id="add_main_ledger" style="width:100%">
                          <option value="">--Select--</option>
                      </select>
                  </div>

                 <div class="form-group">
                      <label>Sub Ledger</label>
                      <select class="form-control select2" style='width:100%' name="add_sub_ledger" id="add_sub_ledger">
                          <option value="">--Select--</option>
                        
                      </select>
                  </div>
               
                 <div class="form-group">
                      <button class="btn btn-primary btn-xs pull-right" id="add_new_ledger">
                          <i class="fa fa-plus" aria-hidden="true"></i> Create Sub Ledger</button>
                  </div>
                  <br>
                  
                 <div class="form-group">
                      <label>Account name</label>
                      <input type="text" class="form-control" name="add_acc_name" id="add_acc_name">
                  </div>
                  
                  
                  <div class="form-group">
                      <label>Type</label>
                      <select class="form-control" name="add_type" id="add_type">
                          <option value="">--Select--</option>
                          <option value = "1">Credit</option>
                          <option value = "2">Debit</option>
                          <option value = "3">Both</option>
                      </select>
                  </div>
                  
                  <div class="form-group">
                      <label>Account tree</label>
                      <select class="form-control" name="tree_type" id="tree_type">
                          <option value="">--Select--</option>
                          <option value="2">Open</option>
                          <option value="3">Close</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label>Apply Form</label>
                      <select class="form-control select2 forms" style='width:100%'  multiple name="apply_form[]" id="apply_form[]">
                          <?php if(isset($formlists) && !empty($formlists)):?>
                            <?php foreach($formlists as $fkey => $fname):?>
                                <option value="<?=$fkey?>"><?=$fname?></option>
                            <?php endforeach;?>
                          <?php endif;?>
                      </select>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
   <div class="modal fade in" id="sub_ledger_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Add Sub Ledger</h4>
            </div>
            <div class="modal-body">
                
              <div class="form-group">
                  <label>Main Ledger</label>
                  <select class="form-control select2" name="main_ledger" id="main_ledger" style="width:100%">
                      <option value="">--Select--</option>
                  </select>
              </div>
                
                <div class="form-group">
                  <label>Ledger name</label> 
                  <input type="text" class="form-control" id="add_sub_ledger_name">
                </div>
                
                  <div class="form-group">
                      <label>Type</label>
                      <select class="form-control" name="s_type" id="s_type">
                          <option value="">--Select--</option>
                          <option value = "1">Credit</option>
                          <option value = "2">Debit</option>
                          <option value = "3">Both</option>
                      </select>
                  </div>
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_sub_ledger_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
   <div class="modal fade in" id="view_model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:white;">×</span></button>
                <h4 class="modal-title text-center">Sub Ledgers</h4>
            </div>
            <div class="modal-body">
                 <div id="view_data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="add_btn">Submit</button>
            </div>
        </div>
    </div>
  </div>
  
  
  <script>
      
       $(document).ready(function(){
           
          $('.select2').select2();
          fetch_main_ledgers();
          main_sub_ledgers();
          
          //fetch_accounts_tree();
          
          $("#add_new_ledger").click(function(){
              
              $("#sub_ledger_modal").modal("toggle");
          });
         
          $("#add_main_ledger").change(function(){
                  var main_ledger = $("#add_main_ledger").val();
                  fetch_all_sub_ledgers(main_ledger);
              });
          
          $("#add_sub_ledger_btn").click(function(){
                var main_ledger_id = $("#main_ledger").val();
                var sub_ledger_name = $("#add_sub_ledger_name").val();
                var add_type = $("#s_type").val();

                  $.ajax({
                        url : "add_sub_ledger",
                        method : "POST",
                        data : {main_ledger_id:main_ledger_id,sub_ledger_name:sub_ledger_name,add_type:add_type},
                        success:function(response)
                        {
                            $("#sub_ledger_modal").modal("toggle");
                             $("#add_model").modal("toggle");
                            $("#main_ledger").val("");
                            $("#add_sub_ledger_name").val("");
                            $("#main_ledger").trigger("change");
                            fetch_all_sub_ledgers();
                            $("#s_type").val("");
                            snackbar_show("Sub-legder was successfully added");
                        }
                  });
              });
              
          
          $("#add_btn").click(function(){
                var main_ledger_id = $("#add_main_ledger").val();
                var add_sub_ledger_id = $("#add_sub_ledger").val();
                var add_acc_name = $("#add_acc_name").val();
                var add_type = $("#add_type").val();
                var tree_type = $("#tree_type").val();
                var forms = $('#apply_form').val();
                var inputValues = [];
                $('.forms').each(function() {
                    inputValues.push($(this).val());
                });
                 
                 if(main_ledger_id == "")
                 {
                     snackbar_show("Select Main Ledger");
                 }
                 else if(add_type == "")
                 {
                     snackbar_show("Select Type Credit / Debit");
                 }
                 else if(tree_type == "")
                 {
                     snackbar_show("Select Tree Type");
                 }
                 else if(add_acc_name == "")
                 {
                     snackbar_show("Select Account Name");
                 }
                 else
                 {
                        $.ajax({
                                url : "add_multi_sub_ledger",
                                method : "POST",
                                data : {main_ledger_id:main_ledger_id,add_sub_ledger_id:add_sub_ledger_id,add_acc_name:add_acc_name,add_type:add_type,tree_type:tree_type,forms: inputValues},
                                beforeSend:function()
                                {
                                     $("#add_btn").attr("disabled",true);
                                },
                                success:function(response)
                                {
                                    $("#add_model").modal("toggle");
                                    $("#add_main_ledger").val("");
                                    $("#add_sub_ledger").val("");
                                    $("#add_sub_ledger").trigger("change");
                                    $("#add_acc_name").val("");
                                    $("#add_btn").attr("disabled",false);
                                    snackbar_show("Sub-legder was successfully added");
                                }
                          });
                 }
                
                  
          });
          
      });
      
      
      
      
      
      
      function fetch_main_ledgers()
      {
          $.ajax({
                    url : "fetch_main_ledgers",
                    method : "POST",
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        var content = "<option value=''>--Select--</option>";
                        
                        for(var i= 0;i<obj.length;i++)
                        {
                            content += "<option value="+obj[i].vchaccid+">"+obj[i].vchaccname+"</option>";
                        }
                        $("#main_ledger").html(content);
                    }
          });
      }
      
      function main_sub_ledgers()
      {
           $.ajax({
                    url : "fetch_main_sub_ledgers",
                    method : "POST",
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        var content = "<option value=''>--Select--</option>";
                        
                        for(var i= 0;i<obj.length;i++)
                        {
                            content += "<option value="+obj[i].vchaccid+">"+obj[i].vchaccname+"</option>";
                        }
                        $("#add_main_ledger").html(content);
                    }
          });
      }
      

      function fetch_all_sub_ledgers(main_ledger)
      {
           $.ajax({
                    url : "fetch_all_sub_ledgers",
                    method : "POST",
                    data : {main_ledger:main_ledger},
                    success:function(response)
                    {
                        var obj = jQuery.parseJSON(response);
                        var content = "<option value=''>--Select--</option>";
                        
                        for(var i= 0;i<obj.length;i++)
                        {
                            content += "<option value="+obj[i].vchaccid+">"+obj[i].vchaccname+"</option>";
                        }
                        $("#add_sub_ledger").html(content);
                    }
          });
      }
      
      function fetch_accounts_tree()
      {
         var content = "";
          content += "<div class='table-responsive'>";
          content += "<table id='table_id' class='table table-hover table-bordered'>"; 
          content += "<thead><th>S.No</th><th>Account Id</th><th>Account Name</th><th>Balance</th></thead>";
          content += "<tbody></tbody>";
          content += "</table>";
          content += "</div>";
          
          $("#table_view").html(content);
    
          $("#table_id").DataTable({
              "processing": true,
              "serverSide": false,
              "ordering": false,
              "pageLength": 25,
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              "ajax":{
                'url':'fetch_accounts_tree',
              }
      });      
      }
      
      function view_data(accid)
      {
           $.ajax({
                     url : "get_child_account_tree",
                     method : "POST",
                     data : {accid:accid},
                     success:function(response)
                     {
                         $("#view_data").html("");
                         $("#view_data").append(response);
                         $("#view_model").modal("toggle");
                     }
           });   
      }
      
      function view_data_1(accid)
      {
           $.ajax({
                     url : "get_child_account_tree",
                     method : "POST",
                     data : {accid:accid},
                     success:function(response)
                     {
                         $("#sub_data").append(response);
                         //$("#view_model").modal("toggle");
                     }
           });   
      }

      function edit_apply_forms(accid)
      {
           $.ajax({
                     url : "fetch_apply_forms",
                     method : "POST",
                     data : {accid:accid},
                     success:function(response)
                     {
                        //  $("#node_data").html("");
                        //  $("#node_data").append(response);

                         $("#edit_forms").html("");
                         $("#edit_forms").append(response);
                         $('.select2').select2();
                        //  $("#nodeModal").modal("toggle");
                     }
           });   
      }

    function searchHTMLTree(searchText) {
      var matchingElements = $('#tree13').find(':contains(' + searchText + ')');
      return matchingElements.toArray().map(function(element) {
        return $(element).text();
      });
    }


    $(document).ready(function() {
        
        $('#openAllNodesButton').on('click', function() {
            $('#tree').find('.branch').each(function() {
                var icon = $(this).children('i:first');
                //icon.removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
                icon.removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
                $(this).children().children().show();
            });
        });

        $('#closeAllNodesButton').on('click', function() {
            $('#tree').find('.branch').each(function() {
                var icon = $(this).children('i:first');
                // icon.removeClass('glyphicon-minus-sign').addClass('glyphicon-plus-sign');
                icon.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
                $(this).children().children().hide();
            });
        });

        $('#searchButton').on('click', function() {
            var searchText = $('#searchInput').val();
                $('#tree li').removeClass('highlight').removeClass('active'); // Remove any previous highlights

                var matchingNode = $('#tree li:contains(' + searchText + ')').first();

                if (matchingNode.length > 0) {
                    matchingNode.addClass('highlight');
                    $('#tree .branch').children('i').addClass('glyphicon-plus-sign').removeClass('glyphicon-minus-sign');
                    
                    matchingNode.parents('.branch').each(function() {
                        var icon = $(this).children('i:first');
                        icon.removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
                        $(this).children().children().show();
                    });
                }
        });

       
        $(document).on('click', '#edit_forms_btn', function(){ 
            var main_ledger_id = $("#ledger_id").val();                
                var forms = $('#apply_form').val();
                var inputValues = [];
                $('.edit-forms').each(function() {
                    inputValues.push($(this).val());
                });
                 
                 if(main_ledger_id == "")
                 {
                     snackbar_show("Select Main Ledger");
                 }                
                 else
                 {
                        $.ajax({
                                url : "edit_ledger_forms",
                                method : "POST",
                                data : {main_ledger_id:main_ledger_id,forms: inputValues},
                                dataType: 'json',
                                beforeSend:function()
                                {
                                     $("#add_btn").attr("disabled",true);
                                },
                                success:function(response)
                                {   
                                    if(response.status == true){
                                        snackbar_show("Successfully Updated");
                                        edit_apply_forms(response.vchaccid);
                                    }                       
                                    
                                    //window.location.reload();
                                }
                          });
                 }
        });
       
    });
    

    
  </script>
  <style>
        .highlight {
            color: yellow;
        }
    </style>
