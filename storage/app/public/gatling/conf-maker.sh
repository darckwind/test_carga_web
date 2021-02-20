#!/bin/bash
echo "ingrese url de la prueba"
echo "ejemplo de url ---> https://revisionendfid.iie.cl/lsv3-desarrollo2/evaluacion/index.php/976812?lang=es"
read -p  "url prueba:" url
read -p  "ingrese cantidad de usuarios simultaneos:" usr

#remuebe todo antes de la especificacion de url

url_a=${url:7}
url_b=${url_a#*/*/}

#remueve los parametros de lenguaje de la url
url_post='"/'${url_b::-8}
url_post=${url_post}'"'
url_c=${url_a:1}
url_base=${url_c%%/*}'"'
url_base='"https://'${url_base}

if test -f "data.conf"; then
        rm -rf data.conf
fi

touch data.conf

echo "url_base = ${url_base}" >> data.conf
echo "url_post = ${url_post}" >> data.conf
echo "n_user = ${usr}" >> data.conf

echo "$url_base,$usr, $url_post"