//Complainica
//By:-iLLuMinaTi

$("#file-btn").click(function(){
    if(isSafe()) {
        $("#full").css("display", "block");
        $("#full").animate({"opacity": "0.6"}, 100, function () {
            $("#confirm-div").css("display", "block");
        });
        $("#confirm-div").animate({"left": "35%"}, 200);
    }
});


$("#can-btn").click(function(){
    $("#confirm-div").animate({"left":"-30%"},200,function(){
        $("#confirm-div").css({"display":"none"});
    });
    $("#full").animate({"opacity":"0"},10);
    $("#full").css({"display":"none"});
});


function isSafe(){
    if($("#subject").val()=="")
    {
        $("#error_msg").show();
        $("#error_msg").html("<strong>Attention!!</strong> &nbsp;Subject cannot be left empty!");
        return 0;
    }
    if($("#description").val()=="")
    {
        $("#error_msg").show();
        $("#error_msg").html("<strong>Attention!!</strong>&nbsp;Particulars  of complain cannot be left empty!");
        return 0;
    }
    if($("#fhrs").val()==$("#thrs").val()&&$("#fmin").val()==$("#tmin").val())
    {
        $("#error_msg").show();
        $("#error_msg").html("<strong>Attention!!</strong>&nbsp;Time Cannot be Same!");
        return 0;
    }
    $("#error_msg").hide();
    return 1;
}
