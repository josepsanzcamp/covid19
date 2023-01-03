set terminal png size 1200,600 enhanced font ',11'
set title "22. Defuncions per comunitat autònoma i any (acumulats per any, les dades >= 2020 són del MoMo i la resta són del INE)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:90000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,15000,75000
set datafile separator ','
set colors classic
set key maxrows 7
set output 'output/plot22ca1.png'
set xrange [-0.5:5.5]
set label 1 "XXX = 1/100 de la població total per comparar la mortalitat respecte la població de la comunitat autònoma " at 5.5,87000 r tc lt 12
set key at 5.5,85000
plot 'middle/plot22ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col,\
            '' u 13:xtic(1) ti col,\
            '' u 14:xtic(1) ti col,\
            '' u 15:xtic(1) ti col
set output 'output/plot22ca2.png'
set xrange [5.5:11.5]
set label 1 "XXX = 1/100 de la població total per comparar la mortalitat respecte la població de la comunitat autònoma " at 5.5+6,87000 r tc lt 12
set key at 5.5+6,85000
plot 'middle/plot22ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col,\
            '' u 13:xtic(1) ti col,\
            '' u 14:xtic(1) ti col,\
            '' u 15:xtic(1) ti col
set output 'output/plot22ca3.png'
set xrange [11.5:17.5]
set label 1 "XXX = 1/100 de la població total per comparar la mortalitat respecte la població de la comunitat autònoma " at 5.5+12,87000 r tc lt 12
set key at 5.5+12,85000
plot 'middle/plot22ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col,\
            '' u 13:xtic(1) ti col,\
            '' u 14:xtic(1) ti col,\
            '' u 15:xtic(1) ti col
