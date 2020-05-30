set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'
set output 'output/plot8en.png'
set multiplot layout 3,1 title "Deaths by year and month of the MoMo related to the download date of the data file"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
plot [-0.5:13.5] 'middle/plot8en.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col
plot [13.5:27.5] 'middle/plot8en.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 12,1750 c tc lt 1
set yrange [0:2000]
plot [1.5:22.5] 'middle/plot8en.csv' using 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col
unset multiplot
