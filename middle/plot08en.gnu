set terminal png size 1200,600 enhanced font ',11'
set title "8. Deaths by year and month of the MoMo related to the download date of the data file and difference between each file"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:70000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,10000,60000
set datafile separator ','
set colors classic
set output 'output/plot08en01.png'
set xrange [-0.5:11.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en02.png'
set xrange [11.5:23.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en03.png'
set xrange [23.5:35.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en04.png'
set xrange [35.5:47.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en05.png'
set xrange [47.5:59.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en06.png'
set xrange [59.5:71.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en07.png'
set xrange [71.5:83.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set output 'output/plot08en08.png'
set xrange [83.5:95.5]
plot 'middle/plot08en.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col
set yrange [0:20000]
set ytics 0,4000,16000
set output 'output/plot08en09.png'
set xrange [35.5:47.5]
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 41.5,18000 c tc lt 1
plot 'middle/plot08en.csv' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col, '' u 14:xtic(1) ti col, '' u 15:xtic(1) ti col, '' u 16:xtic(1) ti col, '' u 17:xtic(1) ti col, '' u 18:xtic(1) ti col
set output 'output/plot08en10.png'
set xrange [47.5:59.5]
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 53.5,18000 c tc lt 1
plot 'middle/plot08en.csv' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col, '' u 14:xtic(1) ti col, '' u 15:xtic(1) ti col, '' u 16:xtic(1) ti col, '' u 17:xtic(1) ti col, '' u 18:xtic(1) ti col
set output 'output/plot08en11.png'
set xrange [59.5:71.5]
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 65.5,18000 c tc lt 1
plot 'middle/plot08en.csv' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col, '' u 14:xtic(1) ti col, '' u 15:xtic(1) ti col, '' u 16:xtic(1) ti col, '' u 17:xtic(1) ti col, '' u 18:xtic(1) ti col
set output 'output/plot08en12.png'
set xrange [71.5:83.5]
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 77.5,18000 c tc lt 1
plot 'middle/plot08en.csv' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col, '' u 14:xtic(1) ti col, '' u 15:xtic(1) ti col, '' u 16:xtic(1) ti col, '' u 17:xtic(1) ti col, '' u 18:xtic(1) ti col
set output 'output/plot08en13.png'
set xrange [83.5:95.5]
set label 1 "Atencion: this plot has a different scale related to the previous plot of the same group" at 89.5,18000 c tc lt 1
plot 'middle/plot08en.csv' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col, '' u 14:xtic(1) ti col, '' u 15:xtic(1) ti col, '' u 16:xtic(1) ti col, '' u 17:xtic(1) ti col, '' u 18:xtic(1) ti col
