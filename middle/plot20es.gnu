set terminal png size 1200,600 enhanced font ',11'
set title "20. Evolución de los datos del Índice Nacional de Defunciones segun cada PDF publicado"
set grid
set tmargin 3
set rmargin 6
set bmargin 5
set lmargin 6
set auto x
set yrange [0:500000]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xtics rotate by -60
set xtics font ',10'
set ytic center rotate by 90
set ytics 0,100000,400000
set datafile separator ','
set colors classic
set key at '2023-01-01',130000
set xrange ['2020-01-01':'2023-01-01']
set output 'output/plot20es1.png'
plot 'middle/plot20es.csv' u 1:8:xtic(1) w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w lp ti col,\
            '' u 1:11 w lp ti col,\
            '' u 1:12 w lp ti col,\
            '' u 1:13 w lp ti col
set key at '2020-01-01',130000
set xrange ['2017-01-01':'2020-01-01']
set output 'output/plot20es2.png'
plot 'middle/plot20es.csv' u 1:5:xtic(1) w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w lp ti col
set key at '2017-01-01',130000
set xrange ['2014-01-01':'2017-01-01']
set output 'output/plot20es3.png'
plot 'middle/plot20es.csv' u 1:2:xtic(1) w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col
