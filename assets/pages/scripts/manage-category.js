//This is the js from the ajax and the options seen from documentation.

var TableDatatables = function(){
   var handleCategoryTable = function(){
      var categoryTable = $("#category_list");
      
      var oTable = categoryTable.dataTable({
         "processing":true,  // Compulsory lines to define the type of code and where is the                         //  code working
         "serverSide":true,  //
         "ajax":{
            url:"http://192.168.0.101/erp/pages/scripts/category/manage.php",
            type:"POST", // type of request used.
         },
         "lengthMenu":[
            [5,15,20,-1],
            [5,15,20,"All"]
         ],
         "pageLength":15,//Set the default length
         "order":[
            [0,"desc"]   //Defaults that are set by javascript
         ],
         "columnDefs":[{
            'orderable':false,  
            'targets':[-1,-2]
         }]
      });
      categoryTable.on('click','.edit',function(e){
         $id = $(this).attr('id');
         $("#edit_category_id").val($id);
         $.ajax({
            url:"http://localhost/erp/pages/scripts/category/fetch.php",
            method:"POST",
            data:{category_id:$id},
            dataType:"json",
            success:function(data){
               $("#category_name").val(data.category_name);
               $("#hsn_code").val(data.hsn_code);
               $("#gst_rate").val(data.gst_rate);
               $("#editModal").modal('show');
            },
         });
      });
      categoryTable.on('click','.delete',function(e){
         $id = $(this).attr('id');
         $("#recordID").val($id);
      });
   }
   return{
      //Main function in javascript to handle all the initialisation part 
      init: function(){
         handleCategoryTable();
      }
   };
}();
jQuery(document).ready(function(){
   TableDatatables.init();
});