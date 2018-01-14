/**
 * Created by iLLuMinaTi on 29-Mar-17.
 */
$("#prog").change();
function decideYear()
{
    console.log("Value is"+$("#prog").val());
    switch ($("#prog").val())
    {
        case "0":

            $("#year").removeAttr("disabled");
            $("#year").html('<option value="1">1st Year</option> <option value="2"> 2nd Year </option> <option value="3"> 3rd Year </option> <option value="4">  Final Year </option>');
            break;
        case  "2":
            $("#year").removeAttr("disabled");
            $("#year").html('<option value="1">1st Year</option> <option value="2"> 2nd Year </option><option value="2"> 3rd Year </option>');
            break;
        case  "1":
        case "3":
            $("#year").removeAttr("disabled");
            $("#year").html('<option value="1">1st Year</option> <option value="2"> 2nd Year </option>');
            break;
        default:
            $("#year").html('<option value="-1"></option>')
            $("#year").attr("disabled","disabled");
    }
}
function decideHostel()
{
    var p=$("#prog").val();
    var yr=$("#year").val();
    var gen=$('input:radio[name=gender]:checked').val();  //taking the value of input of type radio whose name is 'gender' and which is checked
    console.log("Gender is " + gen);
    if(gen=="1") //if male
    {
        console.log(" male")
        switch (p)
        {
            case"0": //if B.Tech
                /*switch (yr)
                 {
                 case "1":
                 $("#hostel").html('<option>SVBH</option>');
                 break;
                 case "2":
                 $("#hostel").html('<option>Tagore Hostel</option><option>Patel Hostel</option><option>Tilak Hostel</option>');
                 break;
                 case "3":
                 $("#hostel").html('<option>Malviya Hostel</option><option>Tandon Hostel</option>');
                 break;
                 case "4":
                 $("#hostel").html('<option>Patel Hostel</option><option>Tilak Hostel</option>');
                 break;

                 }*/
                $("#hostel").html('<option>SVBH</option><option>Tagore Hostel</option><option>Patel Hostel</option><option>Tilak Hostel</option><option>Malviya Hostel</option><option>Tandon Hostel</option>');
                break;
            case "1"://if M.Tech
            case "2": //if MCA
            case "3": //if MBA
            case "4": //if PhD
                $("#hostel").html('<option>Raman Hostel</option><option>PG Hostel</option>');
                break;
        }
    }
    else //if female
    {
        $("#hostel").html('<option>KNGH</option><option>IH</option><option>SNGH</option>');
    }
}
    function decideBranch()
{
    var prog=$("#prog").val();
    var isDisable="required";
    switch (prog)
    {
        case "0":

            $("#branch").removeAttr("disabled");
            $("#branch").html(' <option value="0">Bio-Technology</option><option value="1">Chemical Engineering</option><option value="2">Civil Engineering</option><option value="3">Computer Science & Engineering</option><option value="4">Electrical Engineering</option><option value="5">Electronics & Communication Engineering</option><option value="6">Information Technology</option><option value="7">Mechanical Engineering</option><option value="8">Production & Industrial Engineering</option>');
            break;
        case  "1":
            $("#branch").removeAttr("disabled");
            $("#branch").html(' <option value="9">Applied Mechanics</option><option value="10">Civil Engineering</option><option value="11">GIS Cell</option><option value="12">Computer Science & Engineering</option><option value="13">Electrical Engineering</option><option value="14">Electronics & Communication Engineering</option><option value="15">Mechanical Engineering</option>');
            break;
        case  "2":
        case "3":
        case "4":
            $("#branch").html('<option value="-1"></option>');
            $("#branch").attr("disabled","disabled");
            break;
    }

}

function reset_form(){
    $("form").get(0).reset();
    decideHostel();
    decideYear();
}
