#|/bin/bash

if [ "$1" == "all" ]; then
	rm -f middle/* output/* index.*
	time php program.php
fi

if [ "$1" == "momo" ]; then
	rm -f middle/datanew* output/plot[1,2,3,4,5,8]*
	time php program.php
fi

if [ "$1" == "euromomo" ]; then
	rm -f middle/euromomo* output/plot9*
	time php program.php
fi

