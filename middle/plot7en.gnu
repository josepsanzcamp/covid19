set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'
set title "7. Relation of hospital beds and nurses by country in 2016 according to OECD data"
set rmargin 3
set grid
set auto x
set auto y
set style data histogram
set style fill solid border -1
set xtic rotate by -45 scale 0
set datafile separator ';'
set style histogram gap 3
set output 'output/plot7en1.png'
plot 'middle/plot7en1.csv' u 2:xtic(1) ti col
set output 'output/plot7en2.png'
plot 'middle/plot7en2.csv' u 2:xtic(1) ti col
