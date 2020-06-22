set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "8. Deaths by year and month of the MoMo related to the download date of the data file and difference between each file"
set rmargin 3
set grid
set auto x
set yrange [0:60000]
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
set output 'output/plot8en1.png'
plot [-0.5:13.5] 'middle/plot8en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set output 'output/plot8en2.png'
plot [13.5:27.5] 'middle/plot8en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 12,9000 c tc lt 1
set yrange [0:10000]
set output 'output/plot8en3.png'
plot [0.5:24.5] 'middle/plot8en.csv' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
