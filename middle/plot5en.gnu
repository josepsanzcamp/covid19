set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'
set output 'output/plot5en.png'
set multiplot layout 3,1 title "5. Deaths by autonomous community and year (accumulated by year of March and April, the data for 2020 are from the MoMo and the rest are from the INE)"
set rmargin 3
set grid
set auto x
set yrange [0:30000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:5.5] 'middle/plot5en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col
plot [5.5:11.5] 'middle/plot5en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col
plot [11.5:17.5] 'middle/plot5en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col
unset multiplot
