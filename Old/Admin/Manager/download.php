<?php
	/*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';

    require_once 'dompdf/autoload.inc.php';

    use Dompdf\Dompdf;



    $document = new Dompdf();



    $sql = "SELECT o.id, o.totalprice, o.orderstatus, o.paymentmode, o.`timestamp`, u.firstname, u.lastname 

            FROM orders o JOIN customers u WHERE o.uid=u.uid ORDER BY o.id ASC";

    $res = mysqli_query($connection, $sql);

    $output = "<style>

                    table {

                        border-collapse: collapse;

                        margin: 25px 0;

                        font-size: 0.9em;

                        width: 100%;

                        border-radius: 5px 5px 0 0;

                        overflow: hidden;

                        box-shadow: 0 0 20px rgba(0,0,0,0.15);

                    }



                    table thead tr {

                        background-color: #3498db;

                        color: white;

                        text-align: left;

                        font-weight: bold;

                    }



                    table th,

                    table td {

                        padding: 12px 15px;

                    }



                    table tbody tr {

                        border-bottom: 1px solid #95a5a6;

                    }



                    table tbody tr:nth-of-type(even) {

                        background-color: #ecf0f1;

                    }



                    table tbody tr:last-of-type {

                        border-bottom: 2px solid #3498db;

                    }

             </style>

            <table>

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Customer Name</th>

                        <th>Total Price</th>

                        <th>Order Status</th>

                        <th>Payment Mode</th>

                        <th>Order Placed On</th>

                        <th>Order Received On</th>

                    </tr>

                </thead>

                <tbody>";



                while ($r = mysqli_fetch_assoc($res)) 

                {

                    $output .= '<tr>

                                <th scope="row">'.$r['id'].'</th>

                                <td>'.$r['firstname']. " " . $r['lastname'].'</td>

                                <td>R '.$r['totalprice'].'</td>

                                <td>'.$r['orderstatus'].'</td>

                                <td>'.$r['paymentmode'].'</td>

                                <td>'.$r['timestamp'].'</td>

                                <td>'.$r['timestamp'].'</td>

                              </tr>';



                } 



                $output .= '</tbody>

                            </table>';





    $document->loadHtml($output); 

    

    $document->setPaper('A4', 'landscape');



    $document->render();



    $document->stream("Transaction", array("Attachment"=>0));

?>