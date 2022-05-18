<?php

if (count($arrMulSel) > 1) {
    //bulan tengah
    if ($j != 0 && $j != $lastArrMS) {
        if ($monthMulai == $monthIndex) {
            echo '<td>' . $monthMulai . '<br>' . $monthIndex . '</td>';
            // echo '<td class="date show-date' . $tdflag . ' ' . $class2 . '" style="background-color: black;"></td>';
        }

        if ($monthSelesai == $monthIndex) {
        }

        echo '<td class="date show-date' . $tdflag . ' ' . $class2 . '" style="background-color: #FCE83A;"></td>';
        // tampil warna jika tabel pertama dan di antara tgl mulai dan tgl akhir dalam bulan
    } elseif ($j == 0 && $i >= $day_mulai && $i <= $dim) {
        echo '<td class="date show-date' . $tdflag . ' ' . $class2 . '" style="background-color: #FCE83A;"></td>';
        // bulan akhir
    } elseif ($j == $lastArrMS && $i >= 1 && $i <= $day_selesai) {
        // echo '<td>' . 'ha <br>' . $lastArrMS . '<br>' . $j . '</td>';

        // beri warna hijau jika tanggal sama dengan $day_selesai
        if ($i == $day_selesai) {
            echo '<td class="date show-date' . $tdflag . ' ' . $class2 . '" style="background-color: #2bc155;"></td>';
        } else {
            echo '<td class="date show-date' . $tdflag . ' ' . $class2 . '" style="background-color: #FCE83A;"></td>';
        }
    } else {
        echo '<td class="date show-date' . $tdflag . ' ' . $class2 . '"></td>';
    }
    // jika bulan tgl_mulai dan tgl_selesai sama (1)
}
?>
