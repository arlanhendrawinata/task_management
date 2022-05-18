<?php

use App\Models\Division;
use App\Models\UserDetail;

function getDay($date)
{
  $dateFormat = date("d/m/Y", strtotime($date));
  $day = \Carbon\Carbon::createFromFormat('d/m/Y', $dateFormat)->format('d');
  return $day;
}


function monthList()
{
  $monthList = [
    [
      'id' => 1,
      'nama' => 'January'
    ],
    [
      'id' => 2,
      'nama' => 'February'
    ],
    [
      'id' => 3,
      'nama' => 'March'
    ],
    [
      'id' => 4,
      'nama' => 'April'
    ],
    [
      'id' => 5,
      'nama' => 'May'
    ],
    [
      'id' => 6,
      'nama' => 'June'
    ],
    [
      'id' => 7,
      'nama' => 'July'
    ],
    [
      'id' => 8,
      'nama' => 'August'
    ],
    [
      'id' => 9,
      'nama' => 'September'
    ],
    [
      'id' => 10,
      'nama' => 'October'
    ],
    [
      'id' => 11,
      'nama' => 'November'
    ],
    [
      'id' => 12,
      'nama' => 'December'
    ]
  ];
  // $monthList = [
  //   'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4, 'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8, 'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
  // ];
  return $monthList;
}

function getMonth($val)
{
  $dateFormat = date("d/m/Y", strtotime($val));
  $month = \Carbon\Carbon::createFromFormat('d/m/Y', $dateFormat)->format('m');
  return $month;
}

function getMonthName($array)
{
  // $countArray = count($array);
  $array2 = monthList();
  for ($i = 0; $i < count($array2); $i++) {
    // echo $array[$i];
    for ($j = 0; $j < count($array); $j++) {
      if ($array[$j]['month'] == monthList()[$i]['id']) {
        $real_month[] = [
          'id' => $array[$j]['month'],
          'nama' => monthList()[$i]['nama'],
          'year' => $array[$j]['year'],
        ];
      }
    }
  }
  return $real_month;
}

function initial($str)
{
  $nameparts = explode(" ", $str);
  $ret = '';
  foreach ($nameparts as $word)
    $ret .= strtoupper($word[0]);
  return $ret;
}

function firstname($str)
{
  $nameparts = explode(" ", $str);
  return $nameparts[0];
}

function countMemberTeam($id_divisi)
{
  $count = UserDetail::where('divisi_id', $id_divisi)->count();
  return $count;
}

function read_status()
{
  $status = [
    [
      "id" => 0,
      "nama_status" => "Inactive",
    ],
    [
      "id" => 1,
      "nama_status" => "Active",
    ],
    [
      "id" => 2,
      "nama_status" => "Progress",
    ],
    [
      "id" => 3,
      "nama_status" => "Submited",
    ],
    [
      "id" => 4,
      "nama_status" => "Approved",
    ],
    [
      "id" => 5,
      "nama_status" => "Success",
    ],
    [
      "id" => 6,
      "nama_status" => "Failed",
    ],
    [
      "id" => 7,
      "nama_status" => "Cancelled",
    ],
  ];

  return $status;
}

function status_color()
{
  $color = [
    [
      "id" => 0,
      "color" => "grey",
    ],
    [
      "id" => 1,
      "color" => "info",
    ],
    [
      "id" => 2,
      "color" => "yellow",
    ],
    [
      "id" => 3,
      "color" => "orange",
    ],
    [
      "id" => 4,
      "color" => "teal",
    ],
    [
      "id" => 5,
      "color" => "success",
    ],
    [
      "id" => 6,
      "color" => "danger",
    ],
    [
      "id" => 7,
      "color" => "red",
    ],
  ];
  return $color;
}
