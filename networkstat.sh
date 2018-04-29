#!/bin/bash

salida="$(sudo netstat -antup)"
echo "${salida}"

