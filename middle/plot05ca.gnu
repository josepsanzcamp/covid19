set terminal png size 1200,600 enhanced font ',11'
set title "5. Defuncions per comunitat autònoma i any (acumulats per any de març i abril, les dades del 2020 i 2021 són del MoMo i la resta són del INE)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:30000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,5000,25000
set datafile separator ','
set colors classic
set key maxrows 7
set output 'output/plot05ca1.png'
set xrange [-0.5:5.5]
plot 'middle/plot05ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col
set output 'output/plot05ca2.png'
set xrange [5.5:11.5]
plot 'middle/plot05ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col
set output 'output/plot05ca3.png'
set xrange [11.5:17.5]
plot 'middle/plot05ca.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col,\
            '' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col
