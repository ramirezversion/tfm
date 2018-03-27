#!/bin/bash
echo ""
echo "+-----------------------+"
echo "|                       |"
echo "|    Subiendo cambios   |"
echo "|                       |"
echo "+-----------------------+"
echo ""

git add .
git commit -m "$1"
git push

echo ""
echo "+-----------------------+"
echo "|                       |"
echo "|    Cambios subidos    |"
echo "|                       |"
echo "+-----------------------+"
echo ""
