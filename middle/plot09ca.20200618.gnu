set terminal gif size 1200,600 enhanced font ',10'
set title "9. Defuncions per setmana del any y per pais obtingudes del EuroMoMo (el valor que es mostra es el zscore) (2020-06-18)"
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
set xtics '2020-02-01',86400*30,'2020-12-01'
set ytic center rotate by 90
set ytics 0,10,40
set datafile separator ';'
set output 'output/plot09ca01.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp ti col
set output 'output/plot09ca02.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:8 w lp ti col,'' u 1:9 w lp ti col,'' u 1:10 w lp ti col,'' u 1:11 w lp ti col,'' u 1:12 w lp ti col,'' u 1:13 w lp ti col
set output 'output/plot09ca03.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:14 w lp ti col,'' u 1:15 w lp ti col,'' u 1:16 w lp ti col,'' u 1:17 w lp ti col,'' u 1:18 w lp ti col,'' u 1:19 w lp ti col
set output 'output/plot09ca04.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:20 w lp ti col,'' u 1:21 w lp ti col,'' u 1:22 w lp ti col,'' u 1:23 w lp ti col,'' u 1:24 w lp ti col,'' u 1:25 w lp ti col
set output 'output/plot09ca05.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:26 w lp ti col,'' u 1:27 w lp ti col,'' u 1:28 w lp ti col,'' u 1:29 w lp ti col,'' u 1:30 w lp ti col,'' u 1:31 w lp ti col
set output 'output/plot09ca06.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:32 w lp ti col,'' u 1:33 w lp ti col,'' u 1:34 w lp ti col,'' u 1:35 w lp ti col,'' u 1:36 w lp ti col,'' u 1:37 w lp ti col
set output 'output/plot09ca07.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:38 w lp ti col,'' u 1:39 w lp ti col,'' u 1:40 w lp ti col,'' u 1:41 w lp ti col,'' u 1:42 w lp ti col,'' u 1:43 w lp ti col
set output 'output/plot09ca08.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:44 w lp ti col,'' u 1:45 w lp ti col,'' u 1:46 w lp ti col,'' u 1:47 w lp ti col,'' u 1:48 w lp ti col,'' u 1:49 w lp ti col
set output 'output/plot09ca09.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:50 w lp ti col,'' u 1:51 w lp ti col,'' u 1:52 w lp ti col,'' u 1:53 w lp ti col,'' u 1:54 w lp ti col,'' u 1:55 w lp ti col
set output 'output/plot09ca10.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:56 w lp ti col,'' u 1:57 w lp ti col,'' u 1:58 w lp ti col,'' u 1:59 w lp ti col,'' u 1:60 w lp ti col,'' u 1:61 w lp ti col
set output 'output/plot09ca11.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:62 w lp ti col,'' u 1:63 w lp ti col,'' u 1:64 w lp ti col,'' u 1:65 w lp ti col,'' u 1:66 w lp ti col,'' u 1:67 w lp ti col
set output 'output/plot09ca12.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:68 w lp ti col,'' u 1:69 w lp ti col,'' u 1:70 w lp ti col,'' u 1:71 w lp ti col,'' u 1:72 w lp ti col,'' u 1:73 w lp ti col
set output 'output/plot09ca13.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:74 w lp ti col,'' u 1:75 w lp ti col,'' u 1:76 w lp ti col,'' u 1:77 w lp ti col,'' u 1:78 w lp ti col,'' u 1:79 w lp ti col
set output 'output/plot09ca14.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:80 w lp ti col,'' u 1:81 w lp ti col,'' u 1:82 w lp ti col,'' u 1:83 w lp ti col,'' u 1:84 w lp ti col,'' u 1:85 w lp ti col
set output 'output/plot09ca15.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:86 w lp ti col,'' u 1:87 w lp ti col,'' u 1:88 w lp ti col,'' u 1:89 w lp ti col,'' u 1:90 w lp ti col,'' u 1:91 w lp ti col
set output 'output/plot09ca16.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:92 w lp ti col,'' u 1:93 w lp ti col,'' u 1:94 w lp ti col,'' u 1:95 w lp ti col,'' u 1:96 w lp ti col,'' u 1:97 w lp ti col
set output 'output/plot09ca17.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:98 w lp ti col,'' u 1:99 w lp ti col,'' u 1:100 w lp ti col,'' u 1:101 w lp ti col,'' u 1:102 w lp ti col,'' u 1:103 w lp ti col
set output 'output/plot09ca18.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:104 w lp ti col,'' u 1:105 w lp ti col,'' u 1:106 w lp ti col,'' u 1:107 w lp ti col,'' u 1:108 w lp ti col,'' u 1:109 w lp ti col
set output 'output/plot09ca19.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:110 w lp ti col,'' u 1:111 w lp ti col,'' u 1:112 w lp ti col,'' u 1:113 w lp ti col,'' u 1:114 w lp ti col,'' u 1:115 w lp ti col
set output 'output/plot09ca20.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:116 w lp ti col,'' u 1:117 w lp ti col,'' u 1:118 w lp ti col,'' u 1:119 w lp ti col,'' u 1:120 w lp ti col,'' u 1:121 w lp ti col
set output 'output/plot09ca21.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:122 w lp ti col,'' u 1:123 w lp ti col,'' u 1:124 w lp ti col,'' u 1:125 w lp ti col,'' u 1:126 w lp ti col,'' u 1:127 w lp ti col
set output 'output/plot09ca22.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:128 w lp ti col,'' u 1:129 w lp ti col,'' u 1:130 w lp ti col,'' u 1:131 w lp ti col,'' u 1:132 w lp ti col,'' u 1:133 w lp ti col
set output 'output/plot09ca23.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:134 w lp ti col,'' u 1:135 w lp ti col,'' u 1:136 w lp ti col,'' u 1:137 w lp ti col,'' u 1:138 w lp ti col,'' u 1:139 w lp ti col
set output 'output/plot09ca24.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:140 w lp ti col,'' u 1:141 w lp ti col,'' u 1:142 w lp ti col,'' u 1:143 w lp ti col,'' u 1:144 w lp ti col,'' u 1:145 w lp ti col
set output 'output/plot09ca25.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:146 w lp ti col,'' u 1:147 w lp ti col,'' u 1:148 w lp ti col,'' u 1:149 w lp ti col,'' u 1:150 w lp ti col,'' u 1:151 w lp ti col
set output 'output/plot09ca26.20200618.gif'
plot 'middle/plot09ca.20200618.csv' u 1:152 w lp ti col,'' u 1:153 w lp ti col,'' u 1:154 w lp ti col,'' u 1:155 w lp ti col,'' u 1:156 w lp ti col,'' u 1:157 w lp ti col

