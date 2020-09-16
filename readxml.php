<?php
if(isset($_POST['submit'])){

$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><invoice></invoice>");


    foreach($_POST as $key => $value) {
      $clean = preg_replace("/[^a-zA-Z]/", "", $key);
      $xml->addChild($clean, $value);
    }

    $asXML = $xml->asXML();
    $file = fopen("invoice.xml","w+");
    fwrite($file,$asXML);
    fclose($file);
    print_r(error_get_last());

    if(file_exists('./invoice.xml'))
    {
        $myXML = file_get_contents('./invoice.xml');
        $xml = new SimpleXMLElement($myXML);
        $xmlpretty = $xml->asXML();

        // pretty print the XML in browser
        // header('content-type: text/xml');
        // echo $xmlpretty;

        header('Content-Type: application/xml;');
        header('Content-Disposition: attachment; filename=invoice.xml;');
        readfile('invoice.xml');

    }

}
exit();
?>
