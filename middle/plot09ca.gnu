set terminal png size 1200,600 enhanced font ',11'
set title "9. Defuncions per setmana del any y per pais obtingudes del EuroMoMo (el valor que es mostra es el zscore)"
set grid
set tmargin 3
set rmargin 6
set bmargin 3
set lmargin 6
set auto x
set yrange [-10:50]
set xdata time
set timefmt '%Y-%m-%d'
set format x '%Y-%m-%d'
set xrange ['2020-01-01':'2021-01-01']
set xtics '2020-02-01',86400*30.30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,10,40
set datafile separator ','
set colors classic
set output 'output/plot09ca01.png'
plot 'middle/plot09ca.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp ti col
set output 'output/plot09ca02.png'
plot 'middle/plot09ca.csv' u 1:8 w lp ti col,'' u 1:9 w lp ti col,'' u 1:10 w lp ti col,'' u 1:11 w lp ti col,'' u 1:12 w lp ti col,'' u 1:13 w lp ti col
set output 'output/plot09ca03.png'
plot 'middle/plot09ca.csv' u 1:14 w lp ti col,'' u 1:15 w lp ti col,'' u 1:16 w lp ti col,'' u 1:17 w lp ti col,'' u 1:18 w lp ti col,'' u 1:19 w lp ti col
set output 'output/plot09ca04.png'
plot 'middle/plot09ca.csv' u 1:20 w lp ti col,'' u 1:21 w lp ti col,'' u 1:22 w lp ti col,'' u 1:23 w lp ti col,'' u 1:24 w lp ti col,'' u 1:25 w lp ti col
set output 'output/plot09ca05.png'
plot 'middle/plot09ca.csv' u 1:26 w lp ti col,'' u 1:27 w lp ti col,'' u 1:28 w lp ti col,'' u 1:29 w lp ti col,'' u 1:30 w lp ti col,'' u 1:31 w lp ti col
set output 'output/plot09ca06.png'
plot 'middle/plot09ca.csv' u 1:32 w lp ti col,'' u 1:33 w lp ti col,'' u 1:34 w lp ti col,'' u 1:35 w lp ti col,'' u 1:36 w lp ti col,'' u 1:37 w lp ti col
set output 'output/plot09ca07.png'
plot 'middle/plot09ca.csv' u 1:38 w lp ti col,'' u 1:39 w lp ti col,'' u 1:40 w lp ti col,'' u 1:41 w lp ti col,'' u 1:42 w lp ti col,'' u 1:43 w lp ti col
set output 'output/plot09ca08.png'
plot 'middle/plot09ca.csv' u 1:44 w lp ti col,'' u 1:45 w lp ti col,'' u 1:46 w lp ti col,'' u 1:47 w lp ti col,'' u 1:48 w lp ti col,'' u 1:49 w lp ti col
set output 'output/plot09ca09.png'
plot 'middle/plot09ca.csv' u 1:50 w lp ti col,'' u 1:51 w lp ti col,'' u 1:52 w lp ti col,'' u 1:53 w lp ti col,'' u 1:54 w lp ti col,'' u 1:55 w lp ti col
set output 'output/plot09ca10.png'
plot 'middle/plot09ca.csv' u 1:56 w lp ti col,'' u 1:57 w lp ti col,'' u 1:58 w lp ti col,'' u 1:59 w lp ti col,'' u 1:60 w lp ti col,'' u 1:61 w lp ti col
set output 'output/plot09ca11.png'
plot 'middle/plot09ca.csv' u 1:62 w lp ti col,'' u 1:63 w lp ti col,'' u 1:64 w lp ti col,'' u 1:65 w lp ti col,'' u 1:66 w lp ti col,'' u 1:67 w lp ti col
set output 'output/plot09ca12.png'
plot 'middle/plot09ca.csv' u 1:68 w lp ti col,'' u 1:69 w lp ti col,'' u 1:70 w lp ti col,'' u 1:71 w lp ti col,'' u 1:72 w lp ti col,'' u 1:73 w lp ti col
set output 'output/plot09ca13.png'
plot 'middle/plot09ca.csv' u 1:74 w lp ti col,'' u 1:75 w lp ti col,'' u 1:76 w lp ti col,'' u 1:77 w lp ti col,'' u 1:78 w lp ti col,'' u 1:79 w lp ti col
set output 'output/plot09ca14.png'
plot 'middle/plot09ca.csv' u 1:80 w lp ti col,'' u 1:81 w lp ti col,'' u 1:82 w lp ti col,'' u 1:83 w lp ti col,'' u 1:84 w lp ti col,'' u 1:85 w lp ti col
set output 'output/plot09ca15.png'
plot 'middle/plot09ca.csv' u 1:86 w lp ti col,'' u 1:87 w lp ti col,'' u 1:88 w lp ti col,'' u 1:89 w lp ti col,'' u 1:90 w lp ti col,'' u 1:91 w lp ti col
set output 'output/plot09ca16.png'
plot 'middle/plot09ca.csv' u 1:92 w lp ti col,'' u 1:93 w lp ti col,'' u 1:94 w lp ti col,'' u 1:95 w lp ti col,'' u 1:96 w lp ti col,'' u 1:97 w lp ti col
set output 'output/plot09ca17.png'
plot 'middle/plot09ca.csv' u 1:98 w lp ti col,'' u 1:99 w lp ti col,'' u 1:100 w lp ti col,'' u 1:101 w lp ti col,'' u 1:102 w lp ti col,'' u 1:103 w lp ti col

