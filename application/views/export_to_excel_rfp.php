<?php

    header("Content-type: application/vnd-ms-excel");

    header("Content-Disposition: attachment; filename=IT_MAN -SUPPORT-RFP-".date("(d-m-Y)", strtotime($first_date))." sd ".date("(d-m-Y)", strtotime($second_date)).".xls");

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <title>RFP</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="create-by" content="Reynaldi">

        <meta name="create-date" content="15/05/2019">

        <link href="<?php echo base_url('favicon.ico') ?>" rel="shortcut icon">

    </head>

    <body>

        <table width="100%" border="1">

            <tr>

                <th>NO RFP</th>

                <th>REQUEST BY</th>

                <th>DATE</th>

                <th>APLIKASI</th>

                <th>PROBLEM TYPE</th>

                <th>SUBJECT</th>

                <th>DETAIL</th>

                <th>STATUS</th>

                <th>PIC</th>

                

            <?php

                foreach($row as $r):

                    echo "<tr>";

                    echo "<td>".$r->no_rfp."</td>";

                    echo "<td>".$r->request_by."</td>";

                    echo "<td>".date("d-m-Y", strtotime($r->date))."</td>";

                    echo "<td>".$r->project_name."</td>";

                    echo "<td>".$r->problem_type."</td>";

                    echo "<td>".$r->subject."</td>";

                    echo "<td>".$r->detail."</td>";

                    echo "<td>".$r->status."</td>";

                    echo "</tr>";

                endforeach;

            ?>

        </table>

    </body>

</html>