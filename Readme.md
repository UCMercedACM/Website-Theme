# The theme that runs on the acm website

## Editing

Please make all changes on testing. Use `git checkout testing` to checkout the testing branch.
If your repo does not have the testing branch, use `git checkout --track -b testing origin/testing` to
create the branch and check it out, then `git pull` to check for updates.

`cd` into the folder

Run `npm install` to download the dependencies

You may need to run `sudo npm install -g gulp` in order to install the gulp tool globally

Run `gulp` to startup the dev server

Make changes and your browser will auto preview the changes in real time

Note that if you add a new file (e.g. a new image file), you will need to restart the gulp instance or it will not be seen by the website. This is a know bug (iss #1, marked as WONTFIX)

## Deployment

First, merge the changes into master:

	   git checkout master
	   git merge testing

Now copy all files over from the `dist/` directory into the Website-Deployment repository, found [here](https://github.com/UCMercedACM/Website-Deployment.git)

Commit to the Deployment repo and push it--a webhook is set up that will automatically deploy the website to the server on push to the Depolyment repo (not this one!)

##Troubleshooting

####When starting gulp: `Error: Cannot find module 'something-something'`####

You either forgot to run `gulp install` or someone made a change to the gulpfile so that it now requires a new package. Either way, run `gulp install` in the directory to grab all the required packages.

-------------------------------------------------------------------------------

####When starting gulp: `Error: listen EADDRINUSE`####

Something else is using the port on your computer. The most likely explanation is that you already have a gulp instance running somewhere, so you don't  need to start a new one! Heyo!

-------------------------------------------------------------------------------

####My image isn't showing on the website!####

Did you read the earlier section of this readme? If your image is new, then you need to kill your gulp instance and restart it. [Zeno](https://github.com/ZenoHao) has reported that for some reason, images will only refresh up to three times before mysteriously failing to do so, so if you've changed the image a whole bunch, you might try restarting gulp as well.

Basically, restart gulp and make sure that your link is pointing to the correct location.
