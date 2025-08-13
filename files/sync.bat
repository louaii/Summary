cd C:\Users\lserhal\Desktop\Git\TKG
git add .
set TODAY=%date%
echo %TODAY%
git status
git commit -m "%TODAY%"
git push
cd ..\Summary
git add . 
git status
git commit -m "%TODAY%"
git push
cd ..\Docker Projects
git add . 
git status
git commit -m "%TODAY%"
git push
cd ..\Personal
git add . 
git status
git commit -m "%TODAY%"
git push