$(document).ready(function() {
   
   function table() {
      $("#myTable").submit(function(e){
  e.preventDefault();
  $("#myTable").hide();
     $.ajax({
       
      type: "POST",
        url: "list.php",
        data: $("#myTable").serialize(),
       success: function(data){
         $("#result").html(data);
       }
     })
})
   }
   table();
  
});