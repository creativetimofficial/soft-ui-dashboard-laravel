<?php
if(!function_exists('toMoney')){
    function toMoney($amount){
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $amount);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $amount);
        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;
        
        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);
        
        $totalAmount = $removedThousandSeparator;
        
        $returnMoney = number_format(floatval($totalAmount), 2, ',', '.');
        return 'R$ '.$returnMoney;
    }
}
?>