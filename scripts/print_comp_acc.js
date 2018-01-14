
//function print_comp_heading(id,heading,time)
//{
//    $("#"+id).html(heading);
//    $("#"+id +"> span").html(time);
//}


function print_pending(pend_comp)
{
    for(var i=1;i<=pend_comp;i++)
        $("#pending-accordion").append(' <div class="panel panel-default"><div class="panel-heading comp-head"> <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#pending-accordion" href="#c'+i+'"><div class="c-head-div" id="hc"'+i+'>Complain Heading<span style="margin-left:50%">Time of Complain</span></div></a></h4></div><div id="c'+i+'" class="panel-collapse collapse "><div class="panel-body comp-desc">Complain Description</div></div></div>');
}

function print_past(past_comp)
{
    for(var i=1;i<=past_comp;i++)
        $("#past-accordion").append(' <div class="panel panel-default"><div class="panel-heading comp-head"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#past-accordion" href="#pc'+i+'"><div class="c-head-div" id="hpc'+i+'">Past Complain Heading<span style="margin-left:50%">Time of Complain</span></div></a></h4></div><div id="pc'+i+'" class="panel-collapse collapse"><div class="panel-body comp-desc">Complain Description with date when resolved</div></div></div>');

}