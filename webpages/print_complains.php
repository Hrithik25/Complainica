<?php
/**
 * Created by PhpStorm.
 * User: Family
 * Date: 05-Sep-17
 * Time: 12:58 AM
 */

session_start();
require_once '../core/init.php';
require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$successMsg="";
$errMsg="";
if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']=="yes")
{
    $firstName=$_SESSION['firstName'];
    $lastName=$_SESSION['lastName'];
    $email=$_SESSION['email'];
    $employeeId=$_SESSION['employeeId'];
    $year=$_SESSION['year'];
    $mobileNo=$_SESSION['mobileNo'];
    $address=$_SESSION['address'];
    $department=$_SESSION['department'];
    $division=$_SESSION['division'];
    $post=$_SESSION['post'];
//    print_r($_GET);

    //if there's a cid to print..
    if(isset($_GET['cid']))
    {
            require_once '../core/config.php';
            require_once '../functions/branchConvert.php';
            $date = date_default_timezone_set('Asia/Kolkata');
            $date=date('Y-m-d');



            $sql='SELECT * FROM `complaininfo` c,`studentinfo` s WHERE complainId='.$_GET['cid'].' AND  c.email = s.email' ;
            //echo $sql;
             if ($res = mysqli_query($conn, $sql))
             {

                   echo "Hello";
                    /* fetch associative array */
                    while ($row = mysqli_fetch_assoc($res))
                    {
                        $name = $row['firstName']." ".$row['lastName'];
                        echo $name;

                        $compEmail = $row['email'];
                        $area = $row['area'];
                        $type = $row['type'];
                        $sub = $row['subject'];
                        $parti = $row['particulars'];
                        $dateOfLodge = $row['date'];
                        $need = $row['need'];
                        $status = $row['status'];
                        $regno = $row['regNo'];
                        $resolvedDate = $row['resolvedDate'];
                        $program = $row['program'];
                        $branch = $branchName[$row['branch']];
                        $year  = $row['year'];
                        $mobNo = $row['mobileNo'];
                        $hostel = $row['hostel'];
                        $roomNo = $row['roomNo'];
                        $dateRow="";
                        if($status=="Resolved")
                        {
                                $dateRow=' <tr class="rowDiv">
                                                    <td class="labelSpan">Date of Resolving:</td>
                                                    <td class="areaInput">'.$resolvedDate.'</td>
                                                </tr>';
                        }
                    }
             }

            //now printing it in pdf

        $html ='
                    <html>
                            <head>
                                    <title> Print Complain</title>
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
                                    <link rel="stylesheet" href = "../stylesheets/compPrint.css">
                                    <script src="../lib/jquery-3.1.1.js"></script>
                                    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
                            </head>

                            <body>
                            <div id="headDiv">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="headSpan">Complain Receipt</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="cidSpan">Complain Id: '.$_GET['cid'].'</span></div>
                            <div id="compInfoDiv">
                                    <div id="compInfo">Complain Information</div>

                                     <table id="compInfoTab">
                                            <tr class="rowDiv">
                                                    <td class="labelSpan statusLabel">Status:</td>
                                                    <td class="areaInput statusInput  ">'.$status.'</td>
                                                </tr>
                                             <tr class="rowDiv">
                                                    <td class="labelSpan">Date of Lodge:</td>
                                                    <td class="areaInput">'.$dateOfLodge.'</td>
                                                </tr>'.$dateRow.'
                                             <tr class="rowDiv">
                                                <td class="labelSpan">Subject:</td>
                                                <td class="areaInput">'.$sub.'</td>
                                            </tr>
                                             <tr class="rowDiv">
                                                    <td class="labelSpan">Area of Complain:</td>
                                                    <td class="areaInput">'.$area.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Complain Type:</td>
                                                    <td class="areaInput">'.$type.'</td>
                                                </tr>

                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Description:</td>
                                                    <td class="areaInput">'.$parti.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Item Needs To be:</td>
                                                    <td class="areaInput">'.$need.'</td>
                                                </tr>

                                      </table>


                             </div>
                             <div id="stuInfoDiv">
                                    <div id="stuInfo">Complainer\'s Information</div>

                                     <table id="stuInfoTab">
                                             <tr class="rowDiv">
                                                    <td class="labelSpan">Name:</td>
                                                    <td class="areaInput">'.$name.'</td>
                                                </tr>
                                             <tr class="rowDiv">
                                                <td class="labelSpan">Registration No.:</td>
                                                <td class="areaInput">'.$regno.'</td>
                                            </tr>
                                             <tr class="rowDiv">
                                                    <td class="labelSpan">Email ID:</td>
                                                    <td class="areaInput">'.$compEmail.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Mobile No.:</td>
                                                    <td class="areaInput">'.$mobNo.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Program:</td>
                                                    <td class="areaInput">'.$program.'</td>
                                                </tr>

                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Branch:</td>
                                                    <td class="areaInput">'.$branch.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Year:</td>
                                                    <td class="areaInput">'.$year.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Hostel:</td>
                                                    <td class="areaInput">'.$hostel.'</td>
                                                </tr>
                                                <tr class="rowDiv">
                                                    <td class="labelSpan">Room No.:</td>
                                                    <td class="areaInput">'.$roomNo.'</td>
                                                </tr>

                                      </table>


                             </div>
                             <div class="signDiv">
                                   <div class="signBlank">_______________________</div>
                                    <div class="authSign">Authorised Signature</div>
                             </div>
                             <div class="credits">
                                Designed By: Jyot Mehta, Yash Chapani, Jatin Tayal, Batch: CSE 2015-2019
                             </div>

                            </body>
                    </html>  ';


//           echo $html;

            $dompdf->loadHtml($html);
            $dompdf->render();
            $dompdf->stream("ComplainId_".$_GET['cid'],array("Attachment"=>0));
    }
}
else
{
    session_unset();
    session_destroy();
    header('Location:login-register.php');
    exit();
}