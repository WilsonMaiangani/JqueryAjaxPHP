<?php
/*
* Base API
*/
$data = (object)
[
 "data" => (object)[
  "Categoria" =>  [
   ["id" => '1', 'idSubCategoria' => '1', 'nome' => 'Ação'],
   ["id" => '2', 'idSubCategoria' => '2', 'nome' => 'Terror'],
   ["id" => '3', 'idSubCategoria' => '3', 'nome' => 'Comedia'],
   ["id" => '4', 'idSubCategoria' => '4', 'nome' => 'Animação']
  ],
  "SubCategoria" => [
   ["id" => '1', 'nome' => 'Adrenalina'],
   ["id" => '2', 'nome' => 'Medo'],
   ["id" => '3', 'nome' => 'Rir'],
   ["id" => '4', 'nome' => 'Diversão']
  ]
 ]
];


echo json_encode($data);
