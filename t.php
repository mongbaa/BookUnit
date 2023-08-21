git status .
git pull
git add .
git commit -m 'index'
git push

echo "# BookUnit" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/mongbaa/BookUnit.git
git push -u origin main


