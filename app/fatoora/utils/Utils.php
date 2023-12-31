<?php 

function canonicalizeXML($xmlString)
{
    $doc = new DOMDocument();
    $doc->loadXML($xmlString);

    if ($doc->documentElement) {
        $doc->documentElement->normalize();
        $canonicalized = $doc->C14N(true, false, null, null);
        return $canonicalized;
    }

    return null;
}
