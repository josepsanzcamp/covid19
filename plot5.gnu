set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'
set output 'plot5.png'
set multiplot layout 2,1 title 'Defunciones por comunidad autónoma y año (acumulados por año de marzo y abril, los datos del 2020 son de MoMo y el resto son del INE)'
set rmargin 3
set grid
set auto x
set yrange [0:30000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:9.5] 'plot5.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col
plot [9.5:19.5] 'plot5.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col
unset multiplot
