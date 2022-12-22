#!/bin/bash

# euromomo
i=euromomo
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2=$(find ../../covid19/input/$i|grep component|sort|tail -1)
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
hash2=$(md5sum $file2|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# eurostat
i=eurostat
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2=$(find ../../covid19/input/$i|sort|tail -1)
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
hash2=$(md5sum $file2|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# france
i=france
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2="../../covid19/input/$file1"
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
if [ "$hash0" != "$hash1" -a ! -f "$file2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# germany
i=germany
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2=$(find ../../covid19/input/$i|sort|tail -1)
hash0=$(zcat $file0|gawk 'BEGIN{num=0}{if(match($0,/table/))num=(num+1)%2;if(num)print $0}'|md5sum|gawk '{print $1}')
hash1=$(zcat $file1|gawk 'BEGIN{num=0}{if(match($0,/table/))num=(num+1)%2;if(num)print $0}'|md5sum|gawk '{print $1}')
hash2=$(zcat $file2|gawk 'BEGIN{num=0}{if(match($0,/table/))num=(num+1)%2;if(num)print $0}'|md5sum|gawk '{print $1}')
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# momo
i=momo
for file1 in $(find $i/*); do
    file2="../../covid19/input/$file1"
    file3=$(echo $file2|rev|cut -d. -f2-|rev)".bz2"
    if [ ! -f "$file2" -a ! -f "$file3" ]; then
        echo "Copiar $file1"
        cp $file1 $file2
    fi
done

# norway
i=norway
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2=$(find ../../covid19/input/$i|sort|tail -1)
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
hash2=$(md5sum $file2|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# portugal
i=portugal
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2=$(find ../../covid19/input/$i|sort|tail -1)
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
hash2=$(md5sum $file2|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# spain
i=spain
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2="../../covid19/input/ine/35177.csv.gz"
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
hash2=$(md5sum $file2|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# sweden
i=sweden
file0=$(find $i|sort|tail -2|head -1)
file1=$(find $i|sort|tail -1)
file2=$(find ../../covid19/input/$i|sort|tail -1)
hash0=$(md5sum $file0|cut -d' ' -f1)
hash1=$(md5sum $file1|cut -d' ' -f1)
hash2=$(md5sum $file2|cut -d' ' -f1)
#~ echo $file0
#~ echo $file1
#~ echo $file2
#~ echo $hash0
#~ echo $hash1
#~ echo $hash2
if [ "$hash0" != "$hash1" -a "$hash1" != "$hash2" ]; then
    echo "Copiar $i"
    cp $file1 $file2
fi

# indef
i=indef
for file1 in $(find $i/*); do
    file2="../../covid19/input/$file1"
    if [ ! -f "$file2" ]; then
        echo "Copiar $file1"
        cp $file1 $file2
    fi
done
