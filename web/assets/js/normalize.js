$(document).ready(function(){
   
   /*
    * Forms, fields and buttons
    */
   $(".container").find("> form").addClass("form-horizontal");
   $(".form-horizontal").find("label").addClass("control-label");
   $(".form-horizontal").find("div > div").addClass("control-group");
   $(".form-horizontal").find("input").wrap("<div class='controls' />");
   $(".form-horizontal").find("select").wrap("<div class='controls' />");
   
   $(".form-horizontal").find("p").find("button").parent().addClass("form-actions");
   $("form").find("button[type='submit']").addClass("btn-primary");
   $("form").find("button").addClass("btn");
   
   /*
    * Images
    */
   $(".container").find("img").addClass("img-polaroid");
   
   /*
    * Tables
    */
   $(".container").find("table").addClass("table table-hover");
   
   /*
    * Actions (buttons)
    */
   $(".container").find(".record_actions").addClass("form-actions");
   $(".form-actions").find("li").css({"list-style":"none", "float":"left", "margin-right":"5px"}).find("a").addClass("btn");
});

