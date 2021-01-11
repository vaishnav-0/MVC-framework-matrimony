<?php
   function filterArray(array $array)
   {
       return array_filter($array, function ($value) {
           if ($value) {
               return true;
           }
           return false;
       });
   }
      function HRprint($a)
      {
          echo "<pre>";
          print_r($a);
          echo "</pre>";
      }
