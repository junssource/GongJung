<!doctype html>
<html lang='ko'>
    <head>
        <link rel="icon" herf="data:;base64, iVBORw0KGgo=">
        <meta charset='UTF-8'>
        <meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
        <meta http-equiv='X-UA-Compatible' content='IE=EmulateIE9'>
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='pragma' content='no-cache'>


        <title>api</title>
        <style type='text/css'>
 
             html,body{position:relative; margin:0px; padding:0px; font-size:12px; font-family:돋음,Tahoma; color:#333333;}
             td,input,textarea,select,div{font-size:12px; font-family:돋움,Tahoma; color:#333333;}
             textarea{overflow:auto;}
             a,label{cursor:pointer;}
       ul{width:100%; padding:0; margin:0; list-style:none;}
       li{margin:0; padding:0; display:inline; float:left;}
 
 
             body,dl,dd,dt{padding:0; margin:0;}
 
 
       A:link{text-decoration: none; color:#333333;}
       A:visited{text-decoration: none; color:#333333;}
       A:hover{text-decoration:none; color:#333333;}
 
        </style>

    </head>
    <body>


<!-- <?php
print_r($response);
?> -->
    </body>
</html>
 
<?php
$ch = curl_init();
$url = 'http://openapi.data.go.kr/openapi/service/rest/Covid19/getCovid19SidoInfStateJson'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=v2kBdmyOgWj36IOrHzN3WM1zffNuAt2Ziz44tLP1A1BpsSC%2FA5syvZUHrCGYeFc%2BKhNlgzNcV7sdIH1p%2B7mCpA%3D%3D'; /*Service Key*/
$queryParams .= '&' . urlencode('ServiceKey') . '=' . urlencode('-'); /**/
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /**/
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /**/
$queryParams .= '&' . urlencode('startCreateDt') . '=' . urlencode('20200620'); /**/
$queryParams .= '&' . urlencode('endCreateDt') . '=' . urlencode('20200620'); /**/

curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);

$xml=simplexml_load_string($response);
// print_r($xml);
$obj_addr=$xml->body[0]->items[0]->item[0];

echo "<table border='1'><tr>";
echo "<td>guban</td><td>stdDay</td><td>전일대비 증감수</td><td>격리 해제 수</td><td>5</td><td>6</td>";
echo "</tr>";

foreach($xml->body->items->item as $value) {
    echo "<tr>";
    echo "<td>".$value->gubun;"</td>";
    echo "<td>".$value->stdDay;"</td>";
    echo "<td>".$value->incDec;"</td>";
    echo "<td>".$value->isolIngCnt;"</td>";
    // echo $value->stdDay;
}  
// //     echo $value->incdec;
// }
// Foreach($xml->body->items->item AS $value) {
//     echo $value->seq;
// }

// $obj_addr=$xml->body[0]->items[0]->item[0];

// echo "<table border='1'><tr>";

// echo"<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td>";
// echo"</tr>";

// foreach($obj_addr->item as $value){
//     echo "<tr>";
//     echo "<td>".$value->guban;"</td>";
//     echo "<td>".$value->;"</td>";
//     echo "<td>".$value->3.;"</td>";
//     echo "<td>".$value->4.;"</td>";
//     echo "<td>".$value->5.;"</td>";
//     echo "<td>".$value->6.;"</td>";
//     echo "<tr>";

// }
// echo "</table>";

// var_dump($response);

// $xml=simplexml_load_string($response);
// curl_close($ch);

// $totalCount = $xml->body->totalCount;
// print_r($xml);
// $xml-simplexml_load_string($response);
// var_dump($xml);
// Foreach($xml->body->items->item AS $value){
//     echo $value-stdday>;
// }


// $data = file_get_contents($url);
// $xml = simplexml_load_string($data);
// $obj_addr=$xml->body[0]->item[0];

// echo "<pre>";
// print_r($xml);
// echo "</pre>";
?>
 