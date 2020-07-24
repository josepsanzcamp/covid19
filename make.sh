#|/bin/bash

if [ "$1" == "all" ]; then
	rm -f middle/* output/* index.*
	time php program.php
fi

if [ "$1" == "momo" ]; then
	rm -f middle/datanew* output/plot0[1-5,8]* output/plot12*
	time php program.php
fi

if [ "$1" == "euromomo" ]; then
	rm -f middle/euromomo* output/plot9*
	time php program.php
fi

