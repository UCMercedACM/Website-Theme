# The theme that runs on the acm website

## editing

cd into the folder

Run `npm install` to download the dependencies

at this point, you may need to run `sudo npm install -g gulp` in order to install the gulp tool globally

run `gulp` to startup the dev server

make changes and your browser will auto preview the changes in real time

Note that if you add a new file (e.g. a new image file), you will need to restart the gulp instance or it will not be seen by the website. This is a know bug (issue #1 on the GitHub issues list) and will hopefully be fixed soon.


## deployment

just copy the files over to the ACM Website Repo and push to master
