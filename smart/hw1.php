<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td,th{
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            text-align: center;
        }
    </style>
     <?php
        $servername = "127.0.0.1";
        $username = "root";
        $passwd = "1qaz2wsx";
        $database = "class";
        $con = mysqli_connect($servername,$username,$passwd,$database);
        if (mysqli_connect_error())
            echo "error" . mysqli_connect_error();
        mysqli_query($con,"SET NAMES utf8");
    ?>
</head>
<body>
        <div style="font-weight: bold;font-size: larger;text-align:center">106班學生成績總表</div>
        <table style="margin: auto;">
            <?php
                $sql = "SELECT `students`.`cID` AS '座號',`students`.`cNAME` AS '姓名',`students`.`cSEX` AS '性別',
                `students`.`cAddr` AS '地址',sum(`scorelist`.`score`) as '總分',round(avg(`scorelist`.`score`),2) as '平均'  from `students` left join `scorelist` on `students`.`cID` =`scorelist`.`cID` group by `students`.`cID`
                order by `總分` desc ";

                if ($result = mysqli_query($con,$sql)) {
                    print "<tr style='background-color:#006400';>";
                    while ($data =mysqli_fetch_field($result)) {
                        print "<th>" . $data->name . "</th>";
                    }print "</tr>";
                    $i =0;
                    while ($row =mysqli_fetch_row($result)){
                        if($i++<3)
                            print "<tr style='background-color: #e22a2a;'>";
                        else
                            print "<tr style='background-color: #ffe02e;'>";
                        foreach ($row as $data)
                            print "<td>" . $data . "</td>";
                        print "</tr>";
                    }
                    mysqli_free_result($result);
                }
            ?>
        </table>


</body>
<?php
     mysqli_close($con);
?>
</html>
