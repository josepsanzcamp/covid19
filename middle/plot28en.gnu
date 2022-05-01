set terminal png size 1200,600 enhanced font ',11'
set title "28. Deaths per year obtained from INDef, INE (INE-6545 + INE-02001, INE-35177) and MoMo (MoMoOld, MoMoOld2, MoMo)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [0:600000]
set style data histogram
set style fill solid border -1
set style histogram gap 3
set ytic center rotate by 90
set ytics 0,100000,500000
set datafile separator ','
set colors classic
set output 'output/plot28en.png'
plot 'middle/plot28en.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col
