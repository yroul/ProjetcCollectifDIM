$(document).ready(function(){
   
   /*
    * Forms, fields and buttons
    */
   $(".container").find("> form")
                  .addClass("form-horizontal");
                  
   $(".form-horizontal").find("fieldset div > div:not(#hgr_userbundle_usertype_roles)")
                        .addClass("control-group");
                        
   $(".form-horizontal").find("input:not([type='checkbox'])")
                        .wrap("<div class='controls' />");
                        
   $(".form-horizontal").find("select")
                        .wrap("<div class='controls' />");
                        
   $(".control-group").find("> label:not(.checkbox)")
                      .addClass("control-label");
   
   $(".form-horizontal").find("p")
                        .find("button")
                        .parent()
                        .addClass("form-actions");
                        
   $("form").find("button[type='submit']")
            .addClass("btn-primary");
            
   $("form").find("button")
            .addClass("btn");
            
   $(".form-horizontal").find("input[type='checkbox']")
                        .css("margin-left", "23px")
                        .parent()
                        .find("label")
                        .addClass("checkbox inline");
   
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

